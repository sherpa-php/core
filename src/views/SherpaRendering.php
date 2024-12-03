<?php

class SherpaRendering
{
    public private(set) string $templatePath;

    public private(set) string $viewPath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function render(string $viewPath, array $props = []): self
    {
        extract($props);

        $template = $this->loadTemplate();
        $view = file_get_contents($viewPath);

        str_replace("@Sherpa(.Rendering)", $view, $template);

        return $this;
    }

    private function loadTemplate(): string
    {
        return file_get_contents($this->templatePath);
    }
}