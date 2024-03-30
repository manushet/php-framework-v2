<?php

namespace App\controllers;

use WFM\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Home Page', 'Some description...', 'A few keywords...')
    }
}