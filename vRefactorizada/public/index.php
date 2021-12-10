<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/core/bootstrap.php';

use Slim\Views\PhpRenderer;
use ProyectoWeb\app\controllers\PageController;
use ProyectoWeb\app\controllers\AsociadoController;
use ProyectoWeb\app\controllers\ContactController;
use ProyectoWeb\app\controllers\GaleriaController;
use ProyectoWeb\app\controllers\UserController;
use ProyectoWeb\core\App;

App::bind('rootDir', __DIR__ . '/');

$config = [
    'settings' => [
        'displayErrorDetails' => true
    ],
];
$app = new \Slim\App($config);

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("../src/app/views");

$app->get('/', PageController::class . ':home')->setName("home");
$app->get('/about', PageController::class . ':about')->setName("about");
$app->get('/blog', PageController::class . ':blog')->setName("blog");
$app->get('/single_post', PageController::class . ':singlePost')->setName("singlePost");
$app->map(["GET", "POST"], '/asociados', AsociadoController::class . ':asociados')->setName("asociados");
$app->map(["GET", "POST"], '/galeria', GaleriaController::class . ':galeria')->setName("galeria");
$app->map(["GET", "POST"], '/login', UserController::class . ':login')->setName("login");
$app->map(["GET", "POST"], '/logout', UserController::class . ':logout')->setName("logout");
$app->map(["GET", "POST"], '/register', UserController::class . ':register')->setName("register");
$app->map(["GET", "POST"], '/contact', ContactController::class . ':contact')->setName("contact");


$app->run();