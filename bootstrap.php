<?php

include __DIR__ . '/vendor/autoload.php';

define('PROJECT_PATH', __DIR__);
define('TEMPLATE_PATH', PROJECT_PATH . '/templates');
define('VIEW_CONTROLLER_PATH', PROJECT_PATH . '/mvc');
define('FIXTURES_PATH', PROJECT_PATH . '/fixtures');
define('HELPER_PATH', PROJECT_PATH . '/helper');

include_once VIEW_CONTROLLER_PATH . '/Controller.php';
include_once VIEW_CONTROLLER_PATH . '/View.php';
include_once HELPER_PATH . '/Session.php';

use CodeceptionTesting\MVC\Controller;
use CodeceptionTesting\MVC\View;
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