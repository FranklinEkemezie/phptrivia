<?php

declare(strict_types=1);

namespace App\Views;

use App\Exceptions\ViewException;
use App\Utils\ViewRenderer;

/**
 * @property-read string $path
 * @property-read string $name
 * @property-read array $components
 * @property-read Layout $layout
 * @property-read array $placeholderValues
 */

class View
{
    protected const INCLUDE_DIR     = PUBLIC_VIEWS_FOLDER;
    protected const STYLESHEET_DIR  = '../../assets/css/';
    protected const JAVASCRIPT_DIR  = '../../assets/js/';

    /**
     * View components used by the view
     * @var Component[] $components
     */

    private array $components = [];

    /**
     * CSS stylesheets used by the view
     * @var string[] $stylesheets
     */
    private array $stylesheets = [];

    /**
     * JavaScript files used by the view
     * @var string[] $javascripts
     */
    private array $javascripts = [];



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

    private static function getPlaceholderMatchRegex(?string $prefix=null, bool $prefixOptional=true): string
    {

        $matchNameRegex = "[a-zA-Z-]+";
        if (! is_null($prefix)) {
            return "/\{\{ *$prefix:($matchNameRegex) *\}\}/";
        }

        return "/\{\{ *($matchNameRegex) *\}\}/";

    }

    public function useComponent(Component $component): self
    {
        $this->components[$component->name] = $component;

        return $this;
    }

    public function useStyleSheets(string ...$paths): self
    {
        array_push($this->stylesheets, ...$paths);

        return $this;
    }

    public function useJavaScript(string ...$paths): self
    {
        array_push($this->javascripts, ...$paths);

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
        $componentMatchRegex = static::getPlaceholderMatchRegex('component');
        preg_match_all($componentMatchRegex, $viewContent, $includeComponentsMatch);

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
        
        return ViewRenderer::renderVariables(
            $viewContent,
            $this->placeholderValues,
            onError: fn(string $message) => throw new ViewException($message)
        );
    }

    protected function renderViewContent(): string
    {

        $viewPath = $this->getViewPath();

        // Start output buffering
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();
        if ($viewContent === false) {
            throw new ViewException("Something went wrong rendering view: $viewPath");
        }

        // Render the directives first
        $viewContent = $this->renderDirectives($viewContent);

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

        // Render the directives first
        $layoutContent = $this->layout->renderDirectives($layoutContent);

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

    protected function renderDirectives(string $viewContent): string
    {
        $stylesheets = array_map(function(string $path) {
            return static::STYLESHEET_DIR . $path . '.css';
        }, $this->stylesheets);

        $javascripts = array_map(function(string $path) {
            return static::JAVASCRIPT_DIR . $path . '.js';
        }, $this->javascripts);

        $placeholderValues = array_merge(
            $this->placeholderValues,
            ['stylesheets' => $stylesheets],
            ['javascripts' => $javascripts]
        );

        return ViewRenderer::renderDirectives(
            $viewContent,
            $placeholderValues,
            onError: fn(string $message) => throw new ViewException($message)
        );
    }

    public function render(): string
    {

        $viewContent = is_null($this->layout) ? 
            $this->renderViewContent() :
            $this->renderViewLayout()
        ;

        return $viewContent;

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