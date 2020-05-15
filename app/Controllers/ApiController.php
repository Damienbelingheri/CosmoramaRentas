<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;


class ApiController extends CoreController {

    /**
     * Méthod for api 
     * @Route = /api/sub_category
     *
     * @return void
     */
    public function apiSubcategories()
    {

        $data= SubCategory::findAll();
        header('Content-Type: application/json');
        $myJson = json_encode($data);   
        echo $myJson;
    }

}


