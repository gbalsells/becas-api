<?php

class Alumno extends User{

    public function setAlumnoByUserTeran($id){
        $query = $this->connect()->prepare('SELECT * FROM alumno JOIN usuario ON alumno.idUsuario = usuario.idUsuario WHERE alumno.idUsuario = :id');
        $query->execute(['id' => $id]);

        foreach ($query as $currentAlumno) {
            $this->nombre = $currentAlumno['Nombres'];
            $this->usuario = $currentAlumno['Usuario'];
            $this->apellido = $currentAlumno['Apellidos'];
            $this->email = $currentAlumno['Email'];
            $this->dni = $currentAlumno['DNI'];
            $this->telefono = $currentAlumno['Telefono'];
            $this->Facultad = $currentAlumno['Facultad'];
            $this->Carrera = $currentAlumno['Carrera'];
            $this->Materias = $currentAlumno['MateriasCursando'];
            // $this->AnioIngreso = $currentAlumno['AnioIngreso'];
            // $this->CantidadMaterias = $currentAlumno['CantidadMaterias'];
            // $this->Promedio = $currentAlumno['Promedio'];
            // $this->ExamenesRendidos = $currentAlumno['ExamenesRendidos'];
            // $this->MateriasAprobadas = $currentAlumno['MateriasAprobadas'];
            $this->IntegrantesFamilia = $currentAlumno['IntegrantesFamilia'];
            $this->Ingresos = $currentAlumno['Ingresos'];
            $this->Egresos = $currentAlumno['Egresos'];
            $this->Estado = $currentAlumno['Estado'];
            $this->FechaCreacion = $currentAlumno['FechaCreacion'];
            $this->FechaEdicion = $currentAlumno['FechaEdicion'];
            $this->AniosCarrera = $currentAlumno['AniosCarrera'];
            // $this->Distancia = $currentAlumno['Distancia'];
            // $this->Vulnerabilidad = $currentAlumno['Vulnerabilidad'];
            // $this->Puntaje = $currentAlumno['Puntaje'];
            // $this->Resultado = $currentAlumno['Resultado'];
            $this->idAlumno = $id;
        }
    }

    public function setAlumnoByUserConectar($id){
        $query = $this->connect()->prepare('SELECT * FROM alumnoconectar JOIN usuario ON alumnoconectar.idUsuario = usuario.idUsuario WHERE alumnoconectar.idUsuario = :id');
        $query->execute(['id' => $id]);

        foreach ($query as $currentAlumno) {
            $this->nombre = $currentAlumno['Nombres'];
            $this->usuario = $currentAlumno['Usuario'];
            $this->apellido = $currentAlumno['Apellidos'];
            $this->email = $currentAlumno['Email'];
            $this->dni = $currentAlumno['DNI'];
            $this->telefono = $currentAlumno['Telefono'];
            $this->Facultad = $currentAlumno['Facultad'];
            $this->Carrera = $currentAlumno['Carrera'];
            $this->Materias = $currentAlumno['MateriasCursando'];
            // $this->AnioIngreso = $currentAlumno['AnioIngreso'];
            // $this->CantidadMaterias = $currentAlumno['CantidadMaterias'];
            // $this->Promedio = $currentAlumno['Promedio'];
            // $this->ExamenesRendidos = $currentAlumno['ExamenesRendidos'];
            // $this->MateriasAprobadas = $currentAlumno['MateriasAprobadas'];
            $this->IntegrantesFamilia = $currentAlumno['IntegrantesFamilia'];
            $this->Ingresos = $currentAlumno['Ingresos'];
            $this->CantidadHijos = $currentAlumno['CantidadHijos'];
            $this->Telefono4G = $currentAlumno['Telefono4G'];
            $this->TelefonoLiberado = $currentAlumno['TelefonoLiberado'];
            $this->Compania = $currentAlumno['Compania'];
            $this->MejorCompania = $currentAlumno['MejorCompania'];
            $this->Vulnerabilidad = $currentAlumno['Vulnerabilidad'];
            $this->Estado = $currentAlumno['Estado'];
            $this->FechaCreacion = $currentAlumno['FechaCreacion'];
            $this->FechaEdicion = $currentAlumno['FechaEdicion'];
            $this->AniosCarrera = $currentAlumno['AniosCarrera'];
            // $this->Distancia = $currentAlumno['Distancia'];
            // $this->Vulnerabilidad = $currentAlumno['Vulnerabilidad'];
            // $this->Puntaje = $currentAlumno['Puntaje'];
            // $this->Resultado = $currentAlumno['Resultado'];
            $this->idAlumno = $id;
        }
    }

    public function getId(){
        return $this->idAlumno;
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

    public function getTelefono(){
        return $this->telefono;
    }

    public function getFacultad(){
        return $this->Facultad;
    }

    public function getCarrera(){
        return $this->Carrera;
    }

    public function getAnioIngreso(){
        return $this->AnioIngreso;
    }

    public function getCantidadMaterias(){
        return $this->CantidadMaterias;
    }

    public function getPromedio(){
        return $this->Promedio;
    }

    public function getExamenesRendidos(){
        return $this->ExamenesRendidos;
    }

    public function getMateriasAprobadas(){
        return $this->MateriasAprobadas;
    }

    public function getIntegrantesFamilia(){
        return $this->IntegrantesFamilia;
    }

    public function getIngresos(){
        return $this->Ingresos;
    }

    public function getEgresos(){
        return $this->Egresos;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function getFechaCreacion(){
        return $this->FechaCreacion;
    }

    public function getFechaEdicion(){
        return $this->FechaEdicion;
    }

    public function getAniosCarrera(){
        return $this->AniosCarrera;
    }

    public function getVulnerabilidad(){
        return $this->Vulnerabilidad;
    }

    public function getDistancia(){
        return $this->Distancia;
    }

    public function getPuntaje(){
        return $this->Puntaje;
    }

    public function getResultado(){
        return $this->Resultado;
    }

    public function getMaterias(){
        return $this->Materias;
    }

    public function getCantidadHijos(){
        return $this->CantidadHijos;
    }

    public function getTelefono4G(){
        return $this->Telefono4G;
    }

    public function getTelefonoLiberado(){
        return $this->TelefonoLiberado;
    }

    public function getCompania(){
        return $this->Compania;
    }

    public function getMejorCompania(){
        return $this->MejorCompania;
    }

    public function datosAcademicosConectar($id, $facultad, $carrera, $aniosCarrera, $materias){
        $query = $this->connect()->prepare('INSERT INTO alumnoconectar VALUES(:id, :facultad, :carrera, :aniosCarrera, :materias, now(), null, null, null, null, null, null, null, null, null, null)');
        $query->execute(['id'=> $id, 'facultad' => $facultad, 'carrera' => $carrera, 'materias' => $materias, 'aniosCarrera' => $aniosCarrera]);
    }

    public function datosAcademicos($id, $facultad, $carrera, $aniosCarrera, $materias){
        $query = $this->connect()->prepare('INSERT INTO alumno VALUES(:id, :facultad, :carrera, :aniosCarrera, :materias, now(), null, null, null, null, null)');
        $query->execute(['id'=> $id, 'facultad' => $facultad, 'carrera' => $carrera, 'materias' => $materias, 'aniosCarrera' => $aniosCarrera]);
    }

    // public function datosAcademicos($id, $facultad, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos, $aniosCarrera){
    //     $query = $this->connect()->prepare('INSERT INTO alumno VALUES(:id, :facultad, :carrera, null, :ingreso, :totales, :promedio, :rendidos, :aprobadas, null, null, null, null, now(), null, :aniosCarrera, null, null, null, null)');
    //     $query->execute(['id'=> $id, 'facultad' => $facultad, 'carrera' => $carrera, 'ingreso' => $ingreso, 'promedio' => $promedio, 'aprobadas' => $aprobadas, 'totales' => $totales, 'rendidos' => $rendidos, 'aniosCarrera' => $aniosCarrera]);
    // }

    public function datosFamiliaresConectar($id, $integrantes, $hijos, $ingresos, $telefono4g, $telefonoLiberado, $compania, $mejorCompania, $vulnerabilidad){
        $query = $this->connect()->prepare('UPDATE alumnoconectar SET IntegrantesFamilia = :integrantes, Ingresos = :ingresos, CantidadHijos = :hijos, Telefono4G = :telefono4g, TelefonoLiberado = :telefonoLiberado, Compania = :compania, MejorCompania = :mejorCompania, Vulnerabilidad = :vulnerabilidad, FechaCreacion = now() WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'integrantes' => $integrantes, 'ingresos' => $ingresos, 'hijos' => $hijos, 'telefono4g' => $telefono4g, 'telefonoLiberado' => $telefonoLiberado, 'compania' => $compania, 'mejorCompania' => $mejorCompania, 'vulnerabilidad' => $vulnerabilidad]);
    }

    public function datosFamiliares($id, $ingresos, $egresos, $integrantes){
        $query = $this->connect()->prepare('UPDATE alumno SET IntegrantesFamilia = :integrantes, Ingresos = :ingresos, Egresos = :egresos, FechaCreacion = now() WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'integrantes' => $integrantes, 'ingresos' => $ingresos, 'egresos' => $egresos]);
    }

    public function editarAlumno($id, $facultad, $apellidos, $nombres, $dni, $email, $telefono, $carrera, $ingresos, $egresos, $integrantes, $aniosCarrera, $materias){
        
        $query = $this->connect()->prepare('UPDATE alumno SET Facultad = :facultad, Carrera = :carrera, IntegrantesFamilia = :integrantes, Ingresos = :ingresos, Egresos = :egresos, AniosCarrera = :aniosCarrera, FechaEdicion = now(), MateriasCursando = :materias WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'facultad' => $facultad, 'carrera' => $carrera, 'integrantes' => $integrantes, 'ingresos' => $ingresos, 'egresos' => $egresos, 'aniosCarrera' => $aniosCarrera, 'materias' => $materias]);
        
        $query = $this->connect()->prepare('UPDATE usuario SET Apellidos = :apellidos, Nombres = :nombres, DNI = :dni, Email = :email, Telefono = :telefono WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'apellidos' => $apellidos, 'nombres' => $nombres, 'dni' => $dni, 'email' => $email, 'telefono' => $telefono]);
    }

    public function agregarDatos($id, $vulnerabilidad, $distancia, $merito){  
        $query = $this->connect()->prepare('UPDATE alumno SET Vulnerabilidad = :vulnerabilidad, Distancia = :distancia, Puntaje = :merito WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'vulnerabilidad' => $vulnerabilidad, 'distancia' => $distancia, 'merito' => $merito]);
    }

    public function editarEstado($id, $estado){  
        $query = $this->connect()->prepare('UPDATE alumno SET Estado = :estado WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'estado' => $estado]);
    }

    public function adjuntarPDF($id, $nombre, $tamanio){
        $query1 = $this->connect()->prepare('SELECT Nombre FROM documento WHERE (idAlumno = :id)');
        $query1->execute(['id'=>$id]);

        $result = $query1->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            $query = $this->connect()->prepare('INSERT INTO documento VALUES(null, :id, :nombre, :tamanio)');
            $query->execute(['id'=> $id, 'nombre' => $nombre, 'tamanio' => $tamanio]);
            return false;
        }

    }

    public function tieneDocumentacion($id){
        $query1 = $this->connect()->prepare('SELECT Nombre FROM documento WHERE (idAlumno = :id)');
        $query1->execute(['id'=>$id]);
        
        $result = $query1->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        }
        return false;
    }

    public function listaDocumentacion($id){
        $query1 = $this->connect()->prepare('SELECT Nombre FROM documento WHERE (idAlumno = :id)');
        $query1->execute(['id'=>$id]);

        $result = $query1;
        if ($result) {
            return $result;
        }
        return false;
    }

    public function eliminarDocumentacion($id){
        $query1 = $this->connect()->prepare('DELETE FROM documento WHERE (idAlumno = :id)');
        $query1->execute(['id'=>$id]);

        $result = $query1;
        if ($result) {
            return true;
        }
        return false;
    }
}

?>