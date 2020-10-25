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
        $this->user     = 'root';
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

    public function getAlumnosConectar(){
        $query = $this->connect()->prepare('SELECT * FROM usuario JOIN alumnoconectar ON alumnoconectar.idUsuario = usuario.IdUsuario');
        $query->execute();
        return $query;
    }

    public function getAlumnosModificados(){
        $query = $this->connect()->prepare('SELECT * FROM importacion');
        $query->execute();
        $query2 = $this->connect()->prepare('SELECT * FROM importacion2');
        $query2->execute();
        $query3 = $this->connect()->prepare('SELECT * FROM importacion3');
        $query3->execute();
        return $query;
    }

    public function getResultados(){
        $query = $this->connect()->prepare('SELECT * FROM final1');
        $query->execute();
        return $query;
    }

    public function setResultados($id, $resultado){
        $query = $this->connect()->prepare('UPDATE alumno SET Resultado = :resultado WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'resultado' => $resultado]);
        return $query;
    }

    public function buscarAlumno($param_busqueda){
        $query = $this->connect()->prepare('SELECT * FROM `usuario` JOIN `alumno` ON alumno.idUsuario = usuario.IdUsuario WHERE (Apellidos = :param_busqueda1) OR (Nombres = :param_busqueda2) OR (DNI = :param_busqueda3)');
        $query->execute(['param_busqueda1'=> $param_busqueda, 'param_busqueda2'=> $param_busqueda, 'param_busqueda3'=> $param_busqueda]);
        return $query;
    }

    public function buscarAlumnoConectar($param_busqueda){
        $query = $this->connect()->prepare('SELECT * FROM `usuario` JOIN `alumnoconectar` ON alumnoconectar.idUsuario = usuario.IdUsuario WHERE (Apellidos = :param_busqueda1) OR (Nombres = :param_busqueda2) OR (DNI = :param_busqueda3)');
        $query->execute(['param_busqueda1'=> $param_busqueda, 'param_busqueda2'=> $param_busqueda, 'param_busqueda3'=> $param_busqueda]);
        return $query;
    }
}






?>