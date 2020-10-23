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

    public function createUser($apellidos, $nombres, $email, $dni, $pass, $user, $telefono, $esBecaConectar, $domicilio){
        $query1 = $this->connect()->prepare('SELECT DNI, Usuario, Email FROM usuario WHERE (DNI = :dni OR Usuario = :user OR Email = :email)');
        $query1->execute(['user'=> $user, 'email' => $email, 'dni' => $dni]);

        $result = $query1->fetch(PDO::FETCH_ASSOC);
        if ($result) {

            if ($result['Usuario'] === $user){
                return 'El nombre de usuario ingresado ya fue registrado previamente. Por favor seleccione otro.';
            }
            if ($result['DNI'] === $dni){
                return 'El DNI ingresado ya fue registrado previamente.';
            }
            if ($result['Email'] === $email){
                return 'El Email ingresado ya fue registrado previamente.';
            } else {
                return 'El nombre de usuario ingresado ya fue registrado previamente. Por favor seleccione otro.';
            }
        } else {
            $query = $this->connect()->prepare('INSERT INTO usuario VALUES(null, :apellidos, :nombres, :email, 1, :dni, :user, :pass, :telefono, :esBecaConectar, :domicilio)');
            $query->execute(['user'=> $user, 'pass' => $pass, 'apellidos' => $apellidos, 'nombres' => $nombres, 'email' => $email, 'dni' => $dni, 'telefono' => $telefono, 'esBecaConectar' => $esBecaConectar, 'domicilio' => $domicilio ]);
        }

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
            $this->esBecaConectar = $currentUser['esBecaConectar'];
            $this->domicilio = $currentUser['Domicilio'];
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

    public function hayAlumnoConectar(){
        $query = $this->connect()->prepare('SELECT * FROM alumnoconectar WHERE idUsuario = :user');
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

    public function getBeca(){
        return $this->esBecaConectar;
    }

    public function getDomicilio(){
        return $this->domicilio;
    }
}

?>