<?php 
function esOpcionMenuActiva(string $option): bool{
    if (strpos($_SERVER["REQUEST_URI"], $option)) {
        return true;
    }elseif (strpos($_SERVER["REQUEST_URI"], "/")) {
        return true;
    }{
        return false;
    }
}

function  existeOpcionMenuActivaEnArray(array $options): bool{
//falta por hacer y aun no se como 
    foreach ($options as $value) {
        if (esOpcionMenuActiva($value) !== false) {
            return true;
        }
    }
}