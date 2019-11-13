<?php

class Alumno extends User{

    public function setAlumnoByUser($id){
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
            $this->AnioIngreso = $currentAlumno['AnioIngreso'];
            $this->CantidadMaterias = $currentAlumno['CantidadMaterias'];
            $this->Promedio = $currentAlumno['Promedio'];
            $this->ExamenesRendidos = $currentAlumno['ExamenesRendidos'];
            $this->MateriasAprobadas = $currentAlumno['MateriasAprobadas'];
            $this->IntegrantesFamilia = $currentAlumno['IntegrantesFamilia'];
            $this->Ingresos = $currentAlumno['Ingresos'];
            $this->Egresos = $currentAlumno['Egresos'];
            $this->Estado = $currentAlumno['Estado'];
        }
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

    public function datosAcademicos($id, $facultad, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos){
        $query = $this->connect()->prepare('INSERT INTO alumno VALUES(:id, :facultad, :carrera, null, :ingreso, :totales, :promedio, :rendidos, :aprobadas, null, null, null, null, now())');
        $query->execute(['id'=> $id, 'facultad' => $facultad, 'carrera' => $carrera, 'ingreso' => $ingreso, 'promedio' => $promedio, 'aprobadas' => $aprobadas, 'totales' => $totales, 'rendidos' => $rendidos]);
    }

    public function datosFamiliares($id, $ingresos, $egresos, $integrantes){
        $query = $this->connect()->prepare('UPDATE alumno SET IntegrantesFamilia = :integrantes, Ingresos = :ingresos, Egresos = :egresos, FechaCreacion = now() WHERE idUsuario = :id');
        $query->execute(['id'=> $id, 'integrantes' => $integrantes, 'ingresos' => $ingresos, 'egresos' => $egresos]);
    }
}

?>