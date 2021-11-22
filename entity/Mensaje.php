<?php 

require_once __DIR__ . "./Entity.php";

class texto extends Entity{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $texto;

    /**
     * @var string
     */
    private $fecha;

    /**
     * @param int $id
     * @param string $nombre
     * @param string $apellidos
     * @param string $email
     * @param string $asunto
     * @param string $texto
     * @param $fecha
     */
    public function __construct(int $id,string $nombre, string $apellidos, string $email, string $asunto, string $texto, string $fecha){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nombre = $apellidos;
        $this->nombre = $email;
        $this->nombre = $asunto;
        $this->nombre = $texto;
        $this->fecha = $fecha;
    }

    public function toArray(): array {

        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'email' => $this->getemail(),
            'asunto' => $this->getAsunto(),
            'texto' => $this->getApellidos(),
            'fecha' => $this->getFecha()
        ];
    }

    /**
     * Get the value of nombre
     *
     * @return  string
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param  string  $nombre
     *
     * @return  self
     */ 
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     *
     * @return  string
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @param  string  $apellidos
     *
     * @return  self
     */ 
    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getemail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setemail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of asunto
     *
     * @return  string
     */ 
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set the value of asunto
     *
     * @param  string  $asunto
     *
     * @return  self
     */ 
    public function setAsunto(string $asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get the value of texto
     *
     * @return  string
     */ 
    public function gettexto()
    {
        return $this->texto;
    }

    /**
     * Set the value of texto
     *
     * @param  string  $texto
     *
     * @return  self
     */ 
    public function settexto(string $texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of fecha
     *
     * @return  string
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @param  string  $fecha
     *
     * @return  self
     */ 
    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}