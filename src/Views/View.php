<?php

declare(strict_types=1);

namespace App\Views;

use App\Exceptions\ViewException;

class View
{
    protected const INCLUDE_DIR = PUBLIC_VIEWS_FOLDER;
    /**
     * @var Component[] $components
     */
    private array $components = [];

    /**
     * Create a view
     * @param string $path The relative path to the view
     * @param Layout $layout The layout to use when rendering the view
     */
    public function __construct(
        private string $path,
        private ?string $name=null,
        private ?Layout $layout=null,
        private array $placeholderValues=[]
    )
    {
        $this->name ??= $this->path;
    }

    public function useComponent(Component $component, bool $required=true): self
    {
        $this->components[$component->name] = $component;

        return $this;
    }

    protected function renderComponents(string $viewContent): string
    {

        // Match all the component placeholders
        preg_match_all("/\{\{ *component:([a-zA-Z-]+) *\}\}/", $viewContent, $includeComponentsMatch);

        // Get the name of the components to include
        $includeComponentsName = $includeComponentsMatch[1] ?? [];
        
        // Render the components in the view, one after the other
        foreach($includeComponentsName as $includeComponentName) {
            $includeComponent = $this->components[$includeComponentName] ?? null;
            if(is_null($includeComponent)) {
                throw new ViewException("View component: $includeComponentName not found");
            }

            // Update the view with the component
            $viewContent = preg_replace(
                "/\{\{ *component:$includeComponentName *\}\}/",
                (string) $includeComponent,
                $viewContent
            );

            // // Replace the placeholders for the component
            // $viewContent = $includeComponent?->renderVariables($viewContent);
        }        

        return $viewContent;
    }

    public function renderVariables(string $viewContent): string
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
                $this->placeholderValues[$placeholder] ?? 
                    throw new ViewException("No value for placeholder {{ $placeholder }}"),
                $viewContent
            );
        }

        return $viewContent;
    }

    public function render(): string
    {
        $viewPath = static::INCLUDE_DIR . $this->path . '.php';
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

        // Render the variables in the view
        $viewContent = $this->renderVariables($viewContent);

        // Render the components in the view
        $viewContent =  $this->renderComponents($viewContent);

        return $viewContent;
    }

    public function __toString(): string
    {
        return $this->render();
    }


}