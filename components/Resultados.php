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
<?php
include_once '../models/db.php';
include_once '../constants/salarioMinimo.php';

$db = new DB();
$alumnos = $db->getResultados();

foreach($alumnos as $alumno){
    $nada = $db->setResultados($alumno['id'], $alumno['Resultado']);
    //echo '<p> ' .$alumno['id'] .', ' .$alumno['Resultado'] .'</p>';
};

?>
</div>

