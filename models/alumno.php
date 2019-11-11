<?php

include_once 'db.php';
class Alumno extends User{

    private $facultad;
    private $username;

    public function datosAcademicos($id, $facultad, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos){
        $query = $this->connect()->prepare('INSERT INTO alumno VALUES(:id, :facultad, :carrera, null, :ingreso, :totales, :promedio, :rendidos, :aprobadas, null, null, null, null)');
        $query->execute(['id'=> $id, 'facultad' => $facultad, 'carrera' => $carrera, 'ingreso' => $ingreso, 'promedio' => $promedio, 'aprobadas' => $aprobadas, 'totales' => $totales, 'rendidos' => $rendidos]);
    }

    public function datosFamiliares($id, $ingresos, $egresos, $integrantes){
        $query = $this->connect()->prepare('UPDATE alumno SET IntegrantesFamilia = :integrantes, Ingresos = :ingresos, Egresos = :egresos WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'integrantes' => $integrantes, 'ingresos' => $ingresos, 'egresos' => $egresos]);
    }

    public function setFacultad($facultad) {
        $this->facultad = $facultad;
    }

    public function getFacultad(){
        return $this->facultad;
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE Usuario = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['Nombres'];
            $this->usuario = $currentUser['Usuario'];
            $this->apellido = $currentUser['Apellidos'];
            $this->email = $currentUser['Email'];
            $this->dni = $currentUser['DNI'];
            $this->tipoUsuario = $currentUser['TipoUsuario'];
            $this->id = $currentUser['idUsuario'];
            $this->telefono = $currentUser['Telefono'];
        }
    }

    public function hayAlumno(){
        $query = $this->connect()->prepare('SELECT * FROM alumno WHERE idUsuario = :user');
        $query->execute(['user' => $this->id]);
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function getUsuario(){
        return $this->usuario;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getDNI(){
        return $this->dni;
    }
    public function getTipoUsuario(){
        return $this->tipoUsuario;
    }
    public function getIdUsuario(){
        return $this->id;
    }
    public function getTelefono(){
        return $this->telefono;
    }
}

?>