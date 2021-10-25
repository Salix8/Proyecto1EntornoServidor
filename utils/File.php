<?php

require_once __DIR__ . "/../exceptions/FileException.php";
require_once __DIR__ . "/../utils/utils.php";

class File {
    /**
     * Representar a un unico campo file de un formulario 
     * @var [string]
     */
    private $file;

    /**
     * Nombre del fichero generado en un document root
     * @var [string]
     */
    private $fileName;
    
    /**
     * @param string $fileInput Nombre del Input de tipo image a procesar
     * @param array $mimeTypes Mimes types válidos
     * @param int $maxSize Tamaño máximo en bytes. Si es 0, el tamaño es ilimitado 
     * @throws FileException
     */
    public function __construct(string $fileName, array $mimeTypes = [], int $maxSize = 0)    {
        //Constructor
    }

    /**
     * Devuelve el nombre del fichero creado
     * @return string
     */
    public function getFileName(): string{
        return $this->fileName;
    }

    /**
     * Guarda en $desPath el fichero $this->$fileName
     * @param string $desPath
     * @throws FileException
     */
    public function saveUploadedFile(string $destPath){
        # code...
    }
}
