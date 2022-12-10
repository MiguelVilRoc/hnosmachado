<?php 
class Pedido {
    private $id;
    private $email_cliente;
    private $fecha;
    private $lineas;

    public function __construct($datos)
    {
        $this->id = $datos["id"];
        $this->email_cliente = $datos["email_cliente"];
        $this->fecha = $datos["fecha"];
        $this->lineas = $datos["lineas"];
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        $this->id = $newId;
    }

    public function getEmailCliente() {
        return $this->id_cliente;
    }

    public function setEmailCliente($newIdCliente) {
        $this->id_cliente = $newIdCliente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($newFecha) {
        $this->fecha = $newFecha;
    }

    public function anadirLinea($linea) {
        $this->lineas[] = $linea;
    }
}
?>