<?php

//TODO FAIRE UNE BRANCHE 
// POINT D'ENTRÉE UNIQUE : 
// FrontController

// inclusion des dépendances via Composer
// autoload.php permet de charger d'un coup toutes les dépendances installées avec composer
// mais aussi d'activer le chargement automatique des classes (convention PSR-4)
require_once '../vendor/autoload.php';

//activer les sessions ! 
session_start();




/* ------------
--- ROUTAGE ---
-------------*/


// création de l'objet router
// Cet objet va gérer les routes pour nous, et surtout il va 
$router = new AltoRouter();


// le répertoire (après le nom de domaine) dans lequel on travaille est celui-ci
// Mais on pourrait travailler sans sous-répertoire
// Si il y a un sous-répertoire
if (array_key_exists('BASE_URI', $_SERVER)) {
    // Alors on définit le basePath d'AltoRouter
    $router->setBasePath($_SERVER['BASE_URI']);
    // ainsi, nos routes correspondront à l'URL, après la suite de sous-répertoire
}
// sinon
else {
    // On donne une valeur par défaut à $_SERVER['BASE_URI'] car c'est utilisé dans le CoreController
    $_SERVER['BASE_URI'] = '';
}

// On doit déclarer toutes les "routes" à AltoRouter, afin qu'il puisse nous donner LA "route" correspondante à l'URL courante
// On appelle cela "mapper" les routes
// 1. méthode HTTP : GET ou POST (pour résumer)
// 2. La route : la portion d'URL après le basePath
// 3. Target/Cible : Nom du contrôleur, suivi d'un séparateur (#), suivi du nom de la méthode à appeler
// 4. Le nom de la route : pour identifier la route, on va suivre une convention
//      - "NomDuController-NomDeLaMéthode"
//      - ainsi pour la route /, méthode "home" du MainController => "main-home"

/*
//on aurait pu faire ça au lieu des acls
$routes = [
    ['GET', '/', 'MainController#home', 'main-home', ['admin', 'catalog-manager']],
    ['GET', '/category/list', 'CategoryController#list', 'category-list', ['admin', 'catalog-manager']]
];

foreach($routes as $route){
    $router->map($route[0], $route[1], $route[2], $route[3]);
}
*/
                            /* FRONTOFFICE */
//home
$router->map('GET', '/', 'MainController#home', 'main-home');
//category
$router->map('GET','/category/[i:id]','CategoryController@showCategory', 'main-category');
//product
$router->map('GET','/product/[i:id]','ProductController@showProduct', 'main-product');



                              /* BACKOFFICE */
//home backoffice
$router->map('GET', '/admin', 'UserController#adminHome', 'admin-home');
//login 
$router->map('GET|POST', '/admin/login', 'UserController#login', 'admin-user-login');
//logout
$router->map('GET|POST', '/logout', 'UserController#logout', 'admin-user-logout');
//user-list
$router->map('GET', '/admin/user/list', 'UserController#list', 'admin-user-list');

//user-add
$router->map('GET|POST', '/admin/user/add', 'UserController#add', 'admin-user-add');



//product list
$router->map('GET', '/admin/product/list', 'ProductController#listProductAdmin', 'admin-product-list');

//add-product
$router->map('GET|POST','/admin/product/add', 'ProductController#add', 'admin-product-add');

//update-product
$router->map('GET|POST', '/admin/product/update/[i:id]', 'ProductController#update', 'admin-product-update');


// delete additionals images
$router->map('GET|POST', '/delete/imageAddi/[i:id]', 'ProductController#deleteImageAddi', 'delete-imageAddi');


                                            /* API */
                                        
$router->map('GET|POST', '/api/sub_category', 'ApiController#apiSubcategories', 'api-subcategories');

//TODO changer le controller 
$router->map('GET|POST', '/sendmail', 'ApiController#sendMail', 'sendMail');
/* -------------
--- DISPATCH ---
--------------*/

// On demande à AltoRouter de trouver une route qui correspond à l'URL courante
$match = $router->match();
//dump($match);

// Ensuite, pour dispatcher le code dans la bonne méthode, du bon Controller
// On délègue à une librairie externe : https://packagist.org/packages/benoclock/alto-dispatcher
// 1er argument : la variable $match retournée par AltoRouter
// 2e argument : le "target" (controller & méthode) pour afficher la page 404
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

//pour éviter de répéter partout le namespace, tx ben
$dispatcher->setControllersNamespace('\App\Controllers');


// Une fois le "dispatcher" configuré, on lance le dispatch qui va exécuter la méthode du controller
$dispatcher->dispatch();