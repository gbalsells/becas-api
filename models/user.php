<?php

include_once 'db.php';
class User extends DB{

    private $nombre;
    private $username;

    public function userExists($user, $pass){
        $md5pass = md5($pass);

        $dni = $user;

        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE (Usuario = :user OR CAST(DNI AS UNSIGNED) = :dni) AND password = :pass');
        $query->execute(['user'=> $user, 'pass' => $md5pass, 'dni'=> $dni]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function createUser($apellidos, $nombres, $email, $dni, $pass, $user, $telefono){
        $query = $this->connect()->prepare('INSERT INTO usuario VALUES(null, :apellidos, :nombres, :email, 1, :dni, :user, :pass, :telefono)');
        $query->execute(['user'=> $user, 'pass' => $pass, 'apellidos' => $apellidos, 'nombres' => $nombres, 'email' => $email, 'dni' => $dni, 'telefono' => $telefono ]);
    }

    public function setUser($user){
        $dni = $user;
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE Usuario = :user OR CAST(DNI AS UNSIGNED) = :dni');
        $query->execute(['user' => $user, 'dni'=> $dni ]);

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
        foreach ($query as $alumno) {
            if ($alumno['Ingresos'] && $alumno['Carrera']) {
                return 0; // Devuelve 0 cuando ya tiene todos los datos cargados
            } else if ($alumno['Carrera']){
                return 1; // Devuelve 1 cuando solo tiene datos academicos cargados
            } else {
                return 2; // Devuelve 2 cuando no tiene ningun dato cargado
            }
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