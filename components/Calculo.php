<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas Juan B. Teran</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="lista_alumnos">
        <h2>Alumnos registrados:</h2>
        <table cellspacing="0" cellpadding="0">
        <tr>
            <th>id</th>
            <th>DNI</th>
            <th>Puntaje</th>
            <th>DNI</th>
            <th>Puntaje</th>
            <th>DNI</th>
            <th>Puntaje</th>
        </tr>
<?php
include_once '../models/db.php';
include_once '../constants/salarioMinimo.php';

$db = new DB();
$alumnos = $db->getAlumnosModificados();

foreach($alumnos as $alumno){

    // ALGORITMO DE CALCULO DE MERITOS

    //MERITO FAMILIAR
    $factorCorreccion = ($alumno['Integrantes'] - 4) * ($salarioMinimo /5);
    if ($factorCorreccion < 0) {
        $factorCorreccion = 0;
    }

    if ((floatval($alumno['Ingresos']) - $factorCorreccion) <= $salarioMinimo ) {
        $meritoFamiliar = 40;
    } else if ((floatval($alumno['Ingresos']) - $factorCorreccion) < 3 * $salarioMinimo){
        $meritoFamiliar = -20 * (floatval($alumno['Ingresos']) - $factorCorreccion) / $salarioMinimo + 60;
    } else {
        $meritoFamiliar = 0;
    }

    // MERITO POR PROMEDIO  

    if (floatval($alumno['Promedio']) > 5){
        $meritoPromedio = 4 * floatval($alumno['Promedio']) - 20;                         
    } else {
        $meritoPromedio = 0;                        
    }

    // MERITO POR REGULARIDAD

    $materiasPorAnio = $alumno['CantidadMaterias']/$alumno['DuracionCarrera'];
    if ($alumno['Aprobadas2018'] <= 2) {
        $condicionMaterias = 0;
    } else {
        $condicionMaterias = ($alumno['Aprobadas2018'] - 2)/$materiasPorAnio;
    }

    if ($condicionMaterias > 1) {
        $meritoRegularidad = 10;
    } else {
        $meritoRegularidad = round(10 * $condicionMaterias, 4);
    }

    // SUMA DE MERITOS

    $merito = $meritoPromedio + $meritoFamiliar + $meritoRegularidad + $alumno['Vulnerabilidad'] + $alumno['Distancia'];
    echo '
    <tr>
        <td>' .$alumno['id'] .', </td>
        <td>' .$alumno['DNI'] .', </td>
        <td>' .$merito .' </td>
        <td>' .$alumno['CantidadMaterias'] .' </td>
        <td>' .$alumno['DuracionCarrera'] .' </td>
        <td>' .$alumno['Aprobadas2018'] .' </td>
    </tr>
    ';
}
?>
</table>
</div>

