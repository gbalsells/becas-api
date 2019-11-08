<?php 
include_once 'components/datosAcademicos.php';
include 'models/alumno.php';

$alumno = new Alumno();
$id = $user->getIdUsuario();

if (isset($_POST['facultad']) && isset($_POST['carrera']) && isset($_POST['ingreso']) && isset($_POST['promedio']) && isset($_POST['aprobadas']) && isset($_POST['totales']) && isset($_POST['rendidos'])){
    if ($_POST['facultad'] !== '' || $_POST['carrera'] !== '' || $_POST['ingreso'] !== '' || $_POST['promedio'] !== '' || $_POST['aprobadas'] !== '' || $_POST['totales'] !== '' || $_POST['rendidos'] !== ''){
        $facultad = $_POST['facultad'];
        $carrera = $_POST['carrera'];
        $ingreso = $_POST['ingreso'];
        $promedio = $_POST['promedio'];
        $aprobadas = $_POST['aprobadas'];
        $totales = $_POST['totales'];
        $rendidos = $_POST['rendidos'];
        
        $alumno->datosAcademicos($id, $facultad, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos);
    } else {
        echo 'Debe ingresar todos los datos';
    }
}
?>