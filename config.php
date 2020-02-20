<?php
session_start();
define('DB_SERVER','localhost');
define('DB_NAME','agency');
define('DB_USER','root');
define('DB_PASS','deepak');
define('ROOT_PATH', dirname(__FILE__));
define('SITE_URL', 'http://agency.local');
include_once './classes/Database.php';
include_once './classes/Flash.php';
include_once './vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH.'/templates');
$twig = new \Twig\Environment($loader, [
    //'cache' => ROOT_PATH.'/cache',
]);

$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('ROOT_PATH', ROOT_PATH);
$twig->addGlobal('SITE_URL', SITE_URL);

$function = new Twig\TwigFunction('date', function($format){
    return date($format);
});
$twig->addFunction($function);

$function2 = new Twig\TwigFunction('showFlash', function(){
    classes\Flash::showFlash();
});
$twig->addFunction($function2);