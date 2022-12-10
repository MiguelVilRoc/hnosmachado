<?php

class Usuario {
    private $id;
    private $dni;
    private $nombre;
    private $apellidos;
    private $direccion;
    private $email;
    private $password;
    private $administrador;

    public function __construct($datos) {
        $this->id = $datos["id"];
        $this->dni = $datos["dni"];
        $this->nombre = $datos["nombre"];
        $this->apellidos = $datos["apellidos"];
        $this->direccion = $datos["direccion"];
        $this->email = $datos["email"];
        $this->password = $datos["password"];
        $this->administrador = $datos["administrador"];
    }

    public function getId() {
        return $this->id;
    }

    public function setId($newId) {
        $this->id = $newId;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($newDni) {
        $this->dni = $newDni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($newNombre) {
        $this->nombre = $newNombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($newApellidos) {
        $this->apellidos = $newApellidos;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($newDireccion) {
        $this->direccion = $newDireccion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($newEmail) {
        $this->email = $newEmail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($newPassword) {
        $this->password = $newPassword;
    }

    public function getAdministrador() {
        return $this->administrador;
    }

    public function setAdministrador($newAdministrador) {
        $this->administrador = $newAdministrador;
    }
}

?>