<?php

namespace WFM;

abstract class Controller
{
    public array $data = [];

    public array $meta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

    public ?string $layout = null;

    public ?string $view = null;

    public ?object $model = null;
    
    public function __construct(public array $route = [])
    {

    }

    public function getModel(): void
    {
        $model = 'App\models\\' . $this->route['admin_prefix'] . $this->route['controller'];

        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    public function getView(): void
    {
        $this->view = $this->view ? : $this->route['action'];

        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setMeta(string $title = '', string $description = '', string $keywords = ''): void
    {
        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ];
    }
}