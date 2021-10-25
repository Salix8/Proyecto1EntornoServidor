<?php
    $title = "Galeria";

    require_once "./utils/utils.php";
    require_once "./entity/ImagenGaleria.php";
    require_once "./utils/File.php";
    require_once "./exceptions/FileException.php";

    require_once "./utils/SimpleImage.php";

//Inicializar siempre todas la variables usadads en el controlador y la vista

$info = $description = $urlImagen = "";
$descriptionError = $imagenErr = $hayErrores = false;
$errores = [];

if ("POST" === $_SERVER["REQUEST_METHOD"]) {
    //Procesamos el campo de tipo file
    try {
        //nunca debemos confiar en que llefgan todos los datos!
        if (empty($_POST)){
            throw new FileException("Se ha producido un error al procesar el formulario");
        }
        $imageFile = new File("imagen", array("image/jpeg", "image/jpg", "image/png"), (2*1024*1024));
    } catch (FileException $fe) {
        $errores[] = $fe->getMessage();
        $imagenErr = true;
    }
    $description = sanitizeInput(($_POST["descripcion"] ?? ""));
    if (empty($description)) {
        $errores[] = "La descripcion es obligatoria";
        $descriptionError = true;
    }

    if (0 == count($errores)) {
        $info = "imagen enviada correctamete:";
        $urlImagen = ImagenGaleria::RUTA_IMAGENES_GALLERY . $imageFile->getFileName();
        //Reseteamos los datos del formulario
        $description = "";
    }else {
        $info = "Datos erróneos";
    }
}

include("./views/galeria.view.php");