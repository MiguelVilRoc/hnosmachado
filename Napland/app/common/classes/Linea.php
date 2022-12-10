<?php
class Linea {
   private $id;
   private $id_pedido;
   private $num_linea;
   private $id_producto;
   private $cantidad;
   private $precio_unitario;

   public function __construct($datos)
   {
       $this->id = $datos["id"];
       $this->id_pedido = $datos["id_pedido"];
       $this->num_linea = $datos["num_linea"];
       $this->id_producto = $datos["id_producto"];
       $this->cantidad = $datos["cantidad"];
       $this->precio_unitario = $datos["precio_unitario"];
   }

   public function getId() {
    return $this->id;
    }

    public function setId($newId) {
        $this->id = $newId;
    }

    public function getIdPedido() {
        return $this->id_pedido;
    }

    public function setIdPedido($newIdPedido) {
        $this->id_pedido = $newIdPedido;
    }

    public function getNumLinea() {
        return $this->num_linea;
    }

    public function setNumLinea($newNumLinea) {
        $this->num_linea = $newNumLinea;
    }

    public function getIdProducto() {
        return $this->id_producto;
    }

    public function setIdProducto($newIdProducto) {
        $this->id_producto = $newIdProducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($newCantidad) {
        $this->cantidad = $newCantidad;
    }

    public function getPrecioUnitario() {
        return $this->precio_unitario;
    }

    public function setPrecioUnitario($newPrecioUnitario) {
        $this->precio_unitario = $newPrecioUnitario;
    }
}
?>