<?php

declare(strict_types=1);

namespace App\Views;

use App\Exceptions\ViewException;

class View
{

    protected const INCLUDE_DIR = PUBLIC_VIEWS_FOLDER;

    private array $components = [
        'require' => [],    // components here must be included
        'include' => []     // components here may be included
    ];

    private array $placeholders = [];

    public function __construct(
        private string $relativeViewPath
    )
    {

    }

    public function useComponent(
        string $relativeComponentPath,
        ?string $componentName=null,
        array $componentPlaceholderValues=[],
        bool $required=true
    ): self
    {
        $this->components[
            $required ? 'require' : 'include'
        ][$componentName ?? $relativeComponentPath] = [
            'path' => $relativeComponentPath,
            'placeholderValues' => $componentPlaceholderValues
        ];

        return $this;
    }

    public function setPlaceholderValues(array $placeholders): self
    {        
        $this->placeholders = array_merge(
            $this->placeholders,
            $placeholders
        );

        return $this;
    }

    protected function renderComponents(string $viewContent): string
    {
        // Match all the component placeholders
        preg_match_all("/\{\{ *component:([a-zA-Z-]+) *\}\}/", $viewContent, $includeComponentsMatch);

        // Get the name of the components to include
        $includeComponentsName = $includeComponentsMatch[1] ?? [];

        // Render the components
        foreach ($includeComponentsName as $includeComponentName) {
            $includeComponentIsRequired = array_key_exists($includeComponentName, $this->components['require']);

            $includeComponent = null;
            if ($includeComponentIsRequired)  {
                $component = $this->components['require'][$includeComponentName];
                $includeComponent = (new Component($component['path']))
                    ->setPlaceholderValues($component['placeholderValues']);
            } else if ($component = $this->components['include'][$includeComponentName] ?? null) {
                $includeComponent = (new Component($component['path']))
                    ->setPlaceholderValues($component['placeholderValues']);
            } else
                continue;

            // Update the view with the component
            $viewContent = preg_replace(
                "/\{\{ *component:$includeComponentName *\}\}/",
                (string) $includeComponent,
                $viewContent
            );

            // Replace the placeholders here for the component
            $viewContent = $includeComponent->renderVariables($viewContent);
        }

        return $viewContent;
    }

    protected function renderVariables(string $viewContent): string
    {
        // Match all the variable placeholders
        preg_match_all("/\{\{ *([a-zA-Z_]+) *\}\}/", $viewContent, $placeholdersMatch);

        $placeholders = $placeholdersMatch[1] ?? [];

        // Parse the placeholders and replace them
        foreach($placeholders as $placeholder) {
            // Update the view, replacing the variable placeholders with the values
            // given, and empty string if not provided
            $viewContent = preg_replace(
                "/\{\{ *$placeholder *\}\}/",
                $this->placeholders[$placeholder] ?? 
                    throw new ViewException("No value for placeholder {{ $placeholder }}"),
                $viewContent
            );
        }

        return $viewContent;
    }

    public function render(): string
    {
        $viewPath = static::INCLUDE_DIR . $this->relativeViewPath . '.php';
        if (! file_exists($viewPath)) {
            throw new ViewException("View $viewPath not found");
        }

        // Start output buffering
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();
        if ($viewContent === false) {
            throw new ViewException("Something went wrong rendering view: $viewPath");
        }

        // Render the components
        // The components will replace the corresponding placeholder values
        return $this->renderComponents($viewContent);
    }

    public function __toString()
    {   
        return $this->render();
    }
}