<?php

    $title = "Home";

    require_once "./utils/utils.php";

    include("./entity/ImagenGaleria.php");
    include("./entity/Asociado.php");

    $galeria[] = new ImagenGaleria("1.jpg", "descripcion imagen 1", 1, 3, 10);
    $galeria[] = new ImagenGaleria("2.jpg", "descripcion imagen 2", 1, 2, 6);
    $galeria[] = new ImagenGaleria("3.jpg", "descripcion imagen 3", 1, 4, 10);
    $galeria[] = new ImagenGaleria("4.jpg", "descripcion imagen 4", 1, 5, 100);
    $galeria[] = new ImagenGaleria("5.jpg", "descripcion imagen 5", 1, 6, 2);
    $galeria[] = new ImagenGaleria("6.jpg", "descripcion imagen 6", 1, 7, 10);
    $galeria[] = new ImagenGaleria("7.jpg", "descripcion imagen 7", 1, 9, 28);
    $galeria[] = new ImagenGaleria("8.jpg", "descripcion imagen 8", 1, 9, 10);
    $galeria[] = new ImagenGaleria("9.jpg", "descripcion imagen 9", 1, 3, 89);
    $galeria[] = new ImagenGaleria("10.jpg", "descripcion imagen 10", 1, 3, 9);
    $galeria[] = new ImagenGaleria("11.jpg", "descripcion imagen 11", 1, 3, 1);
    $galeria[] = new ImagenGaleria("12.jpg", "descripcion imagen 12", 1, 3, 23);

    $asociados[] = new Asociado("First Partner Name", "log1.jpg", "descripcion logo 1");
    $asociados[] = new Asociado("Second Partner Name", "log2.jpg", "descripcion logo 2");
    $asociados[] = new Asociado("Third Partner Name", "log3.jpg", "descripcion logo 3");

    $asociados = getAsociados($asociados);


    include("./views/index.view.php");