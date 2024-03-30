<?php

namespace App\controllers;

use App\models\Main as MainModel;
use WFM\Controller;

/**
 * @property MainModel $model
 */
class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Home Page', 'Some description...', 'A few keywords...');
        
        
        $all_products = $this->model->getAllProducts();

        $this->setData([
            'test' => 'a test variable from Main Controller',
            'products' => $all_products,
        ]);
    }
}