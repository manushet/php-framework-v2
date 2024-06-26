<?php

namespace WFM;

class View
{
    public string $content = '';

    public function __construct(
        public array $route,
        public ?string $layout,
        public ?string $view,
        public ?array $meta,
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ? : LAYOUT;
        }
    }

    public function render(array $data) 
    {
        if (is_array($data)) {
            extract($data);
        }

        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);

        $view_file = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";

        if (is_file($view_file)) {
            ob_start();

            require_once($view_file);

            $this->content = ob_get_clean();
        } else {
            throw new \Exception("View {$view_file} is not found", 500);
        }

        if (false !== $this->layout) {
            $layout_file = APP . "/views/layouts/{$this->layout}.php";

            if (is_file($layout_file)) {
                require_once($layout_file);
            } else {
                throw new \Exception("Layout {$layout_file} is not found", 500);
            }
        }
    }
    public function getMeta()
    {
        $out = '<title>' . htmlspecialchars($this->meta['title']) . '</title>' . PHP_EOL; 
        $out .= '<meta name="description" content="' . htmlspecialchars($this->meta['description']) . '">' . PHP_EOL; 
        $out .= '<meta name="keywords" content="' . htmlspecialchars($this->meta['keywords']) . '">' . PHP_EOL; 

        return $out;
    }

    public function getPart(string $file, ?array $data = []): void
    {
        if (is_array($data)) {
            extract($data);
        }

        $file = APP . "/views/{$file}.php";

        if (is_file($file)) {
            require($file);
        } else {
            throw new \Exception("Part file {$file} is not found");
        }
    }
}