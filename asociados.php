<?php
    $title = "Asociados";

    require_once "./utils/utils.php";
    require_once "./entity/Asociado.php";
    require_once "./utils/File.php";
    require_once "./exceptions/FileException.php";

    require_once "./utils/SimpleImage.php";

//Inicializar siempre todas la variables usadads en el controlador y la vista

$info = $description = $urlLogo = $nombreLogo = "";
$descriptionError = $nombreLogoError = $logoErr = $hayErrores = false;
$errores = [];

if ("POST" === $_SERVER["REQUEST_METHOD"]) {
    //Procesamos el campo de tipo file
    try {
        //nunca debemos confiar en que llefgan todos los datos!
        if (empty($_POST)){
            throw new FileException("Se ha producido un error al procesar el formulario");
        }
        $logoFile = new File("logo", array("image/jpeg", "image/jpg", "image/png"), (2*1024*1024));
        $logoFile->saveUploadedFile(Asociado::RUTA_IMAGENES_ASOCIADO);
        try {
            // Create a new SimpleImage object
            $simpleImage = new \claviska\SimpleImage();
            $simpleImage
            ->fromFile(Asociado::RUTA_IMAGENES_ASOCIADO . $logoFile->getFileName())
            ->resize(50, 50)
            ->toFile(Asociado::RUTA_IMAGENES_ASOCIADO . $logoFile->getFileName());
        }catch(Exception $err) {
            $errores[]= $err->getMessage();
            $logoErr = true;
        }
    } catch (FileException $fe) {
        $errores[] = $fe->getMessage();
        $logoErr = true;
    }
    $nombreLogo = sanitizeInput(($_POST["nombreLogo"] ?? ""));
    if (empty($nombreLogo)) {
        $errores[] = "El nombre es obligatorio";
        $nombreLogoError = true;
    }

    $description = sanitizeInput(($_POST["description"] ?? ""));
    if (empty($description)) {
        $errores[] = "La descripcion es obligatoria";
        $descriptionError = true;
    }

    if (0 == count($errores)) {
        $info = "imagen enviada correctamete:";
        $urlLogo = Asociado::RUTA_IMAGENES_ASOCIADO . $logoFile->getFileName();
        //Reseteamos los datos del formulario
        $description = "";
        $nombreLogo = "";
    }else {
        $info = "Datos erróneos";
    }
}

include("./views/asociado.view.php");