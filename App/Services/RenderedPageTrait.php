<?php

namespace Spichka\Usl\Services;

trait RenderedPageTrait
{
    /**
     * Render a template file
     * @param string $template
     * @param array<string, mixed> $data
     * @return void
     */
    public static function renderTemplate(string $template, array $data = []): void
    {
        extract($data);
        $template_file = plugin_dir_path(dirname(__FILE__)) . "Views/$template.php";
        if (file_exists($template_file)) {
            include $template_file;
        }
    }
}
