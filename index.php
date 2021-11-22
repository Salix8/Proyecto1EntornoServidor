<?php
    $title = "Home";
    require_once "./utils/utils.php";
    require_once "./entity/ImagenGaleria.php";
    require_once "./entity/Asociado.php";
    require_once "./database/Connection.php";
    require_once "./core/App.php";
    require_once "./repository/AsociadoRepository.php";
    require_once "./repository/ImagenGaleriaRepository.php";

    
    $config = require_once 'app/config.php';
    App::bind("config", $config);
    App::bind("connection", Connection::make($config['database']));

    $repositorio = new ImagenGaleriaRepository();
    $galeria = $repositorio->findAll();

    $repositorio = new AsociadoRepository();
    $asociados = $repositorio->findAll();


    include("./views/index.view.php");