<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas UNT</title>
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
        header("Content-Disposition: attachment; filename=alumnos_conectividad.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
?>
      <?php

      include_once '../models/db.php';
      $db = new DB();
      $alumnos = $db->getAlumnosConectar();
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
           <th>Subió documentación</th>
           <th>Telefono</th>
           <th>Domicilio</th>
           <th>Localidad</th>
           <th>Provincia</th>
           <th>Facultad</th>
           <th>Carrera</th>
           <th>Materias cursando en modalidad virtual</th>
           <th>Integrantes de grupo familiar</th>
           <th>Integrantes que utilizan Internet</th>
           <th>Fuente de Ingresos</th>
           <th>Es responsable de</th>
           <th>Fecha de creacion</th>
           <th>Fecha de edicion</th>
           <th>Tiene teléfono 4G</th>
           <th>Tiene teléfono Liberado</th>
           <th>Comapañía que posee</th>
           <th>Compañía que mejor funciona en su zona</th>
           <th>Vulnerabilidad</th>
        </tr>';

        foreach($alumnos as $alumno){
            $documentacion = $db->tieneDocumentacion($alumno['idUsuario']);
            $tieneDoc = 'NO';
                echo '
                <tr>
                    <td>' .$alumno['idUsuario'] .'</td>
                    <td>' .$alumno['Apellidos'] .'</td>
                    <td>' .$alumno['Nombres'] .'</td>
                    <td>' .$alumno['Email'] .'</td>
                    <td>' .$alumno['DNI'] .'</td>
                    <td>' .$alumno['Usuario'] .'</td>';
                foreach($documentacion as $documento){
                    $tieneDoc = 'SI';
                }
                echo '
                    <td>' .$tieneDoc .'</td>
                    <td>' .$alumno['Telefono'] .'</td>
                    <td>' .$alumno['Domicilio'] .'</td>
                    <td>' .$alumno['Localidad'] .'</td>
                    <td>' .$alumno['Provincia'] .'</td>
                    <td>' .$alumno['Facultad'] .'</td>
                    <td>' .$alumno['Carrera'] .'</td>
                    <td>' .$alumno['MateriasCursando'] .'</td>
                    <td>' .$alumno['IntegrantesFamilia'] .'</td>
                    <td>' .$alumno['FamiliaresInternet'] .'</td>
                    <td>' .$alumno['Ingresos'] .'</td>
                    <td>' .$alumno['CantidadHijos'] .'</td>
                    <td>' .$alumno['FechaCreacion'] .'</td>
                    <td>' .$alumno['FechaEdicion'] .'</td>
                    <td>' .$alumno['Telefono4G'] .'</td>
                    <td>' .$alumno['TelefonoLiberado'] .'</td>
                    <td>' .$alumno['Compania'] .'</td>
                    <td>' .$alumno['MejorCompania'] .'</td>
                    <td>' .$alumno['Vulnerabilidad'] .'</td>
                </tr>
                ';
            }
        }
        echo '
       </table>';
      ?>
    </div>
</body>