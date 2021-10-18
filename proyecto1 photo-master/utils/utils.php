<?php 
function esOpcionMenuActiva(string $option): bool{
    if (strpos($_SERVER["REQUEST_URI"], $option)) {
        return true;
    }elseif (strpos($_SERVER["REQUEST_URI"], "/")) {
        return true;
    }else{
        return false;
    }
}

function  existeOpcionMenuActivaEnArray(array $options): bool{
    foreach ($options as $value) {
        if (esOpcionMenuActiva($value) !== false) {
            return true;
        }
    }
    return false;
}