<?php

namespace App\models;

use WFM\Db;
use WFM\Model;

class Main extends Model
{
    public function getAllProducts(): array
    {
        $query = Db::getConnection()->prepare('SELECT * FROM products ORDER BY name;');

        $query->execute();

        $results = $query->fetchAll();
        //$results = $query->fetch();

        return $results;
    }
}