<?php

ini_set("display_errors", On);
error_reporting(E_ALL | E_STRICT);

// Autoloader 

function autoload($className)
{
   $autoloadPath = array(
       '/home/masao-masao/products/easymenu/src/model',
   );
   foreach ($autoloadPath as $path) {
       if (file_exists($path.'/'.$className.'.php')) {
           require_once($path.'/'.$className.'.php');
           return;
       }
   }
}

spl_autoload_register('autoload');

require '../../products/easymenu/src/Slim/Slim.php';
require '../../products/easymenu/src/Util/facebook.php';
require '../../products/easymenu/vender/smarty/Smarty.class.php';

\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => new \Slim\Views\Smarty(),
));

$view = $app->view();
$view->setTemplatesDirectory('../../products/easymenu/templates');
$view->parserCompileDirectory = '../../products/easymenu/compiled';
$view->parserCacheDirectory = '../../products/easymenu/cache';


// DB接続
require("/home/masao-masao/products/easymenu/config.php");
$app->db = new PDO($host,$user,$pass);
$app->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function checkLogin(){
    session_start();
    if (empty($_SESSION['login_user_id'])){
        header("location: /easymenu/login");
        exit();
    }
}





// Top Page Routing
$app->get('/', 'checkLogin', function () use ($app) {
    if (file_exists('../../products/easymenu/src/controller/top.php')) {
        require_once ('../../products/easymenu/src/controller/top.php');
    } else {
        $app->notFound();
    }
});


// login
$app->get('/login', function () use ($app) {
    if (file_exists('../../products/easymenu/src/controller/login.php')) {
        require_once ('../../products/easymenu/src/controller/login.php');
    } else {
        $app->notFound();
    }
});


// test
$app->get('/test', function () use ($app) {
    if (file_exists('../../products/easymenu/src/controller/test.php')) {
        require_once ('../../products/easymenu/src/controller/test.php');
    } else {
        $app->notFound();
    }
});


// Default Routing
$app->map('/:module(/:id1)(/:id2)(/:id3)', 'checkLogin', function ($module, $id1 = null, $id2 = null, $id3 = null) use ($app) {
    if (file_exists('../../products/easymenu/src/controller/'.basename($module).'.php')) {
        require_once ('../../products/easymenu/src/controller/'.basename($module).'.php');
    } else {
        $app->notFound();
    }
})->via('GET', 'POST')->conditions(array('module' => '\w+', 'id1' => '[\w-]+', 'id2' => '\w+', 'id3' => '\w+'));


// Not Found Page
$app->notFound(function () use ($app) {
    $app->render('404.tpl');
});

$app->run();
