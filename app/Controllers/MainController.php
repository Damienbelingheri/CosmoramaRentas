<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        //pas de passage dans la vue car déja présent dans la méthode show()
        //pour les récuperer aussi dans la nav
        $this->show('front/main/home');
    }

}






