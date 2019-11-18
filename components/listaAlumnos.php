<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas Juan B. Teran</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <div class="lista_alumnos">
      <h2>Alumnos registrados:</h2>
      <?php

      include_once 'models/db.php';
      $db = new DB();
      $alumnos = $db->getAlumnos();
      foreach($alumnos as $alumno){
        $id = $alumno['idUsuario'];
        echo '
        <div class="alumno" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
          <span>' .$alumno['Apellidos'] .', ' .$alumno['Nombres'] . '</span>
          <span>' .$alumno['DNI'] .'</span>
          <span>' .$alumno['Facultad'] .'</span>
          <span>' .$alumno['Carrera'] .'</span>
        </div>';
      }
      ?>
    </div>
</body>