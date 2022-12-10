<?php
class Producto {
    private $id;
    private $nombre;
    private $ancho;
    private $largo;
    private $descripcion;
    private $stock;
    private $id_categoria;
    private $nombre_categoria;
    private $precio_unitario;

    public function __construct($datos)
    {
        $this->id = $datos["id"];
        $this->nombre = $datos["nombre"];
        $this->ancho = $datos["ancho"];
        $this->largo = $datos["largo"];
        $this->descripcion = $datos["descripcion"];
        $this->stock = $datos["stock"];
        $this->id_categoria = $datos["id_categoria"];
        $this->nombre_categoria = $datos["nombre_categoria"];
        $this->precio_unitario = $datos["precio_unitario"];
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

    public function getAncho() {
        return $this->ancho;
    }

    public function setAncho($newAncho) {
        $this->ancho = $newAncho;
    }

    public function getLargo() {
        return $this->largo;
    }

    public function setLargo($newLargo) {
        $this->largo = $newLargo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($newDescripcion) {
        $this->descripcion = $newDescripcion;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($newStock) {
        $this->stock = $newStock;
    }

    public function getIdCategoria() {
        return $this->id_categoria;
    }

    public function setNombreCategoria($newNombreCategoria) {
        $this->nombre_categoria = $newNombreCategoria;
    }

    public function getNombreCategoria() {
        return $this->nombre_categoria;
    }

    public function setIdCategoria($newIdCategoria) {
        $this->id_categoria = $newIdCategoria;
    }

    public function getPrecioUnitario() {
        return $this->precio_unitario;
    }

    public function setPrecioUnitario($newPrecioUnitario) {
        $this->precio_unitario = $newPrecioUnitario;
    }
}
?>