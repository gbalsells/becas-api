<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'jbteran';
        $this->user     = 'gb';
        $this->password = "gbalsells";
        $this->charset  = 'utf8mb4';
    }

    function connect(){
    
        try{
            
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;

        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }

    public function getAlumnos(){
        $query = $this->connect()->prepare('SELECT * FROM usuario JOIN alumno ON alumno.idUsuario = usuario.IdUsuario');
        $query->execute();
        return $query;
    }

    public function buscarAlumno($param_busqueda){
        $query = $this->connect()->prepare('SELECT * FROM `usuario` JOIN `alumno` ON alumno.idUsuario = usuario.IdUsuario WHERE (Apellidos = :param_busqueda1) OR (Nombres = :param_busqueda2) OR (DNI = :param_busqueda3)');
        $query->execute(['param_busqueda1'=> $param_busqueda, 'param_busqueda2'=> $param_busqueda, 'param_busqueda3'=> $param_busqueda]);
        return $query;
    }

    public function verificarMail($mail){
        $query = $this->connect()->prepare('SELECT * FROM `usuario` JOIN `alumno` ON alumno.idUsuario = usuario.IdUsuario WHERE Email = :mail');
        $query->execute(['mail'=> $mail]);
        return $query;
    }
}






?>