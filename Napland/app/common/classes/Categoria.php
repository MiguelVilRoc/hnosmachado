<?php

class Categoria {
    private $id;
    private $nombre;
    private $descripcion;

    public function __construct($datos)
    {
        $this->id = $datos["id"];
        $this->nombre = $datos["nombre"];
        $this->descripcion = $datos["descripcion"];
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        $this->id = $newId;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($newNombre) {
        $this->nombre = $newNombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($newDescripcion) {
        $this->descripcion = $newDescripcion;
    }

}


?>