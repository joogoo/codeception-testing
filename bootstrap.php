<?php

include __DIR__ . '/vendor/autoload.php';

include_once __DIR__ . '/Controller.php';
include_once __DIR__ . '/View.php';
include_once __DIR__ . '/Session.php';

define('TEMPLATE_PATH', __DIR__. '/templates');


use CodeceptionTesting\Controller;
use CodeceptionTesting\View;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;



$app = new Application(); 

/** Home page **/
$app->get('/', function (Request $request) {
    $controller = new Controller($request);
    $view = new View('base');
    
    return $view->parse($controller->actionIndex());
});
$app->get('/signin', function (Request $request) {
    $controller = new Controller($request);
    $view = new View('base');
    
    return $view->parse($controller->actionIndex());
});

/** Sign-in **/
$app->post('/signin', function (Request $request) {
    $controller = new Controller($request);
    $view = new View('base');
    
    return $view->parse($controller->actionSignIn());
});

/** Sign-out **/
$app->get('/signout', function (Request $request) use ($app) {
    $controller = new Controller($request);
    
    $controller->actionSignout();
    return $app->redirect('/');
}); 

$app->run(); 