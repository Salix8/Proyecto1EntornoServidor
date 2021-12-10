<?php

namespace ProyectoWeb\app\controllers;

use Psr\Container\ContainerInterface;
use ProyectoWeb\entity\ImagenGaleria;
use ProyectoWeb\entity\Asociado;
use ProyectoWeb\repository\ImagenGaleriaRepository;
use ProyectoWeb\repository\AsociadoRepository;
use ProyectoWeb\core\App;    
use ProyectoWeb\utils\Forms\InputElement;
use ProyectoWeb\utils\Forms\LabelElement;
use ProyectoWeb\utils\Forms\TextareaElement;
use ProyectoWeb\utils\Forms\ButtonElement;
use ProyectoWeb\utils\Forms\FileElement;
use ProyectoWeb\utils\Forms\FormElement;

use ProyectoWeb\utils\Forms\custom\MyFormControl;
use ProyectoWeb\utils\Validator\NotEmptyValidator;
use ProyectoWeb\utils\Validator\MimetypeValidator;
use ProyectoWeb\utils\Validator\MaxSizeValidator;
use ProyectoWeb\exceptions\QueryException;

class PageController

{

    protected $container;

    // constructor receives container instance

    public function __construct(ContainerInterface $container) {

        $this->container = $container;

    }

    public function home($request, $response, $args) {

        $title = "Home";

        //  $response->getBody()->Write("Inicio");  
        $repositorio = new ImagenGaleriaRepository();
        $galeria = $repositorio->findAll();
        
        $repositorioAsociados = new AsociadoRepository();
        $asociados = $repositorioAsociados->findAll();

        
        return $this
            ->container
            ->renderer
            ->render($response, "index.view.php", compact('title', 'galeria', 'asociados'));

    }

    public function about($request, $response, $args) {

        $title = "About";
        return $this
            ->container
            ->renderer
            ->render($response, "about.view.php", compact('title'));
    }

    public function blog($request, $response, $args) {

        $title = "Blog";
        return $this
            ->container
            ->renderer
            ->render($response, "blog.view.php", compact('title'));
    }

    public function singlePost($request, $response, $args) {

        $title = "Single Post";
        return $this
            ->container
            ->renderer
            ->render($response, "single_post.view.php", compact('title'));
    }
    

}

