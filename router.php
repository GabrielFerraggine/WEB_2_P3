<?php
    
    require_once './libs/router.php';
    require_once './app/controllers/controllerHelados.php';

    $router = new Router();

    #                     endpoint          verbo             controller             metodo
    $router->addRoute('helados'          , 'GET',     'ControllerHelados',   'returnIceCreams');
    $router->addRoute('helados/:id'      , 'GET',     'ControllerHelados',   'returnIceCream');
    $router->addRoute('helados'          , 'POST',    'ControllerHelados',   'addIceCream');
    $router->addRoute('helados/:id'      , 'PUT',     'ControllerHelados',   'editIceCream'); 
    $router->addRoute('helados/:id'      , 'DELETE',  'ControllerHelados',   'delete');                                      
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);