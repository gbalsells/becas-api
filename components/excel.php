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
<?php
    include_once '../models/user_session.php';
    require_once '../models/user.php';
    $userSession = new UserSession();
    $user = new User();

    if (isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser($user));
    }

    if ($user->getTipoUsuario() === 0){
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=alumnos_jbteran.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
?>
      <?php

      include_once '../models/db.php';
      $db = new DB();
      $alumnos = $db->getAlumnos();
      if ($user->getTipoUsuario() === 0){
        echo '
        <div class="lista_alumnos">
        <h2>Alumnos registrados:</h2>
        <table cellspacing="0" cellpadding="0">
        <tr>
           <th>id</th>
           <th>Apellidos</th>
           <th>Nombres</th>
           <th>Email</th>
           <th>DNI</th>
           <th>Usuario</th>
           <th>Telefono</th>
           <th>Facultad</th>
           <th>Carrera</th>
           <th>Año de ingreso a la facultad</th>
           <th>Cantidad de materias de la carrera</th>
           <th>Promedio</th>
           <th>Examenes rendidos en total</th>
           <th>Materias aprobadas en total</th>
           <th>Integrantes de grupo familiar</th>
           <th>Ingresos</th>
           <th>Egresos</th>
           <th>Fecha de creacion</th>
           <th>Fecha de edicion</th>
           <th>Años de la carrera</th>
           <th>Distancia</th>
           <th>Vulnerabilidad</th>
           <th>Puntaje</th>
        </tr>';
        foreach($alumnos as $alumno){
        echo '
        <tr>
            <td>' .$alumno['idUsuario'] .'</td>
            <td>' .$alumno['Apellidos'] .'</td>
            <td>' .$alumno['Nombres'] .'</td>
            <td>' .$alumno['Email'] .'</td>
            <td>' .$alumno['DNI'] .'</td>
            <td>' .$alumno['Usuario'] .'</td>
            <td>' .$alumno['Telefono'] .'</td>
            <td>' .$alumno['Facultad'] .'</td>
            <td>' .$alumno['Carrera'] .'</td>
            <td>' .$alumno['AnioIngreso'] .'</td>
            <td>' .$alumno['CantidadMaterias'] .'</td>
            <td>' .$alumno['Promedio'] .'</td>
            <td>' .$alumno['ExamenesRendidos'] .'</td>
            <td>' .$alumno['MateriasAprobadas'] .'</td>
            <td>' .$alumno['IntegrantesFamilia'] .'</td>
            <td>' .$alumno['Ingresos'] .'</td>
            <td>' .$alumno['Egresos'] .'</td>
            <td>' .$alumno['FechaCreacion'] .'</td>
            <td>' .$alumno['FechaEdicion'] .'</td>
            <td>' .$alumno['AniosCarrera'] .'</td>
            <td>' .$alumno['Distancia'] .'</td>
            <td>' .$alumno['Vulnerabilidad'] .'</td>
            <td>' .$alumno['Puntaje'] .'</td>
        </tr>
        ';
        }
        echo '
       </table>';
    }
      ?>
    </div>
</body>