<?php

declare(strict_types=1);

namespace App\Views;

use App\Exceptions\ViewException;

/**
 * @property-read string $path
 * @property-read string $name
 * @property-read array $components
 * @property-read Layout $layout
 * @property-read array $placeholderValues
 */

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

    /**
     * Get the absolute path of the view
     * @throws \App\Exceptions\ViewException the file does not exists
     * @return string
     */
    protected function getViewPath(): string
    {
        $viewPath = static::INCLUDE_DIR . $this->path . '.php';
        if (! file_exists($viewPath)) {
            throw new ViewException("View $viewPath not found");
        }

        return $viewPath;
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
                throw new ViewException("View component: $includeComponentName not found when rendering " . static::class . " '{$this->name}'");
            }

            // Update the view with the component
            $viewContent = preg_replace(
                "/\{\{ *component:$includeComponentName *\}\}/",
                (string) $includeComponent,
                $viewContent
            );
        }        

        return $viewContent;
    }

    protected function renderVariables(string $viewContent): string
    {
        // Match all the variable placeholders
        preg_match_all("/\{\{ *(:?)([a-zA-Z-_]+) *\}\}/", $viewContent, $placeholdersMatch);
        
        // Parse the placeholders and replace them
        foreach(($placeholdersMatch[2] ?? []) as $i => $placeholder) {
            // Update the view, replacing the variable placeholders with the values
            // given, and empty string if not provided

            $viewContent = preg_replace(
                "/\{\{ *(:?)$placeholder *\}\}/",
                $this->placeholderValues[$placeholder] ?? 
                    // Check if it is optional
                    (
                        $placeholdersMatch[1][$i] === ":" ? "" :
                        throw new ViewException("No value for placeholder {{ $placeholder }}")
                    ),
                $viewContent
            );
        }

        return $viewContent;
    }

    protected function renderViewContent(): string
    {

        // Start output buffering
        ob_start();
        include $this->getViewPath();
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

    protected function renderViewLayout(): string
    {

        $layoutPath = $this->layout->getViewPath();        

        // Start output buffering
        ob_start();
        include $layoutPath;
        $layoutContent = ob_get_clean();
        if ($layoutContent === false) {
            throw new ViewException("Something went wrong rendering layout view: $layoutPath");
        }

        // Render the placeholders in the layout
        $layoutContent = $this->layout->renderVariables($layoutContent);

        // Match all the default component placeholders
        preg_match_all("/\{\{ *\&component:([a-zA-Z-]+) *\}\}/", $layoutContent, $includeDefaultComponentsMatch);

        // Get the name of the components to include
        $includeDefaultComponentsName = $includeDefaultComponentsMatch[1] ?? [];

        // Render the default components
        foreach($includeDefaultComponentsName as $includeDefaultComponentName) {
            $includeDefaultComponent = new Component($includeDefaultComponentName);

            // Update the view with the default component
            $layoutContent = preg_replace(
                "/\{\{ *\&component:$includeDefaultComponentName *\}\}/",
                (string) $includeDefaultComponent,
                $layoutContent
            );
        }

        // Render the layout component
        $layoutContent = $this->layout->renderComponents($layoutContent);

        // Lastly, render the actual view content
        $layoutContent = preg_replace(
            "/\{\{ *\&view *\}\}/",
            $this->renderViewContent(),
            $layoutContent
        );
        
        return $layoutContent;
    }

    public function render(): string
    {

        return is_null($this->layout) ? 
            $this->renderViewContent() :
            $this->renderViewLayout()
        ;

    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception('Cannont access non-existing property ' . __CLASS__ . '::$' . $name);
    }



}