<?php

include_once 'db.php';

class Facultad extends DB{

    public $nombre;
    public $carreras;

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setCarreras($carreras){
        $this->carreras = $carreras;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getCarreras(){
        return $this->carreras;
    }
}
?>