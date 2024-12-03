<?php

namespace Sherpa\Core\views;

class SherpaRendering
{
    public private(set) string $templatePath;

    public private(set) string $viewPath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function render(string $viewPath,
                           array $props = [],
                           string $title = ""): self
    {
        extract($props);

        $template = $this->loadTemplate();

        ob_start();
        include $viewPath;
        $view = ob_get_clean();

        $rendering = preg_replace_callback(
            "/@Sherpa\(Env\.([A-Z_]+)\)/",
            function ($matches)
            {
                return $_ENV[$matches[1]] ?? $matches[0];
            },
            $template);

        $rendering = str_replace(
            "@Sherpa(Local.Title)",
            $title,
            $rendering);

        echo str_replace(
            "@Sherpa(.Rendering)",
            $view,
            $rendering);

        return $this;
    }

    private function loadTemplate(): string
    {
        return file_get_contents($this->templatePath);
    }
}