<?php

include_once 'db.php';
class User extends DB{

    private $nombre;
    private $username;

    public function userExists($user, $pass){
        $md5pass = md5($pass);

        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE Usuario = :user AND password = :pass');
        $query->execute(['user'=> $user, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE Usuario = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            //echo $currentUser;
            $this->nombre = $currentUser['Nombres'];
            $this->usuario = $currentUser['Usuario'];
            $this->apellido = $currentUser['Apellidos'];
            $this->email = $currentUser['Email'];
            $this->dni = $currentUser['DNI'];
            $this->tipoUsuario = $currentUser['TipoUsuario'];
            $this->id = $currentUser['idUsuario'];
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
}

?>