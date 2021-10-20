<?php

    $title = "Contact";

    require_once "./utils/utils.php";

    include("./views/contact.view.php");

    $firstName = $lastName = $email = $subject = $message = "";
    $firstNameError = $emailErr = $subjectError = $hayErrores = false;
    $errores = [];

    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        //Nunca confiar en que llegan todos los datos!!
        $firstName = sanitizeInput($_POST["firstName"] ?? "");
        $lastName = sanitizeInput($_POST["lastName"] ?? ""); //Campo opcional
        $email = sanitizeInput($_POST["email"] ?? "");
        $subject = sanitizeInput($_POST["subject"] ?? "");
        $message = sanitizeInput($_POST["message"] ?? ""); //Campo opcional
        //ahora hacer las comprobaciones
    }

    