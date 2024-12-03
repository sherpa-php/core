<?php

namespace Sherpa\Core\views;

/**
 * Sherpa Rendering entity class.
 * <p>
 *     Allows to render view.
 * </p>
 */
class SherpaRendering
{
    /** `template.html` path */
    public private(set) string $templatePath;
    public private(set) string $viewPath;

    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * Renders saved view.
     * <ul>
     *     <li>Loads all props.</li>
     *     <li>Loads template view.</li>
     *     <li>Loads view.</li>
     *     <li>Prepare template for rendering
     *         (computes Sherpa vars)</li>
     * </ul>
     *
     * @param string $viewPath
     * @param array $props
     * @param string $title (optional) Page's title
     * @return $this
     */
    public function render(string $viewPath,
                           array $props = [],
                           string $title = ""): self
    {
        extract($props);

        $template = $this->loadTemplate();

        ob_start();
        include $viewPath;
        $view = ob_get_clean();


        /* Sherpa Template variables */
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

    /**
     * Loads template's file using saved template's path.
     *
     * @return string Template content (not processed)
     */
    private function loadTemplate(): string
    {
        return file_get_contents($this->templatePath);
    }
}