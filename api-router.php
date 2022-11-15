<?php
require_once './libs/router.php';
require_once './app/controllers/CategoriesApiController.php';
require_once './app/controllers/ProductsApiController.php';

$router = new Router();

//ruteo de categorias
$router->addRoute('categories', 'GET', 'CategoriesApiController', 'getCategories');
$router->addRoute('categories/:ID', 'GET', 'CategoriesApiController', 'getCategoryById');
$router->addRoute('categories', 'POST', 'CategoriesApiController', 'postCategory');
$router->addRoute('categories/:ID', 'PUT', 'CategoriesApiController', 'putCategory');
$router->addRoute('categories/:ID', 'DELETE', 'CategoriesApiController', 'deleteCategory');
//ruteo de productos
$router->addRoute('products', 'GET', 'ProductsApiController', 'getProducts');
$router->addRoute('products/:ID', 'GET', 'ProductsApiController', 'getProductById');
$router->addRoute('products/category/:ID', 'GET', 'ProductsApiController', 'getProductsByCategory');
$router->addRoute('products', 'POST', 'ProductsApiController', 'postProduct');
$router->addRoute('products/:ID', 'PUT', 'ProductsApiController', 'putProduct');
$router->addRoute('products/:ID', 'DELETE', 'ProductsApiController', 'deleteProduct');

$router->route(mb_strtolower($_GET["resource"]), $_SERVER['REQUEST_METHOD']);