<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Becas Juan B. Teran</title>
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <nav class="top-bar">
        Bienvenido, <?php echo $user->getNombre(); ?>
        <a href="models/logout.php">Cerrar sesión</a>
    </nav>
    <div class="lista_alumnos">
      <h2>Alumnos registrados:</h2>
      <?php

      include_once 'models/db.php';
      $db = new DB();
      $dir = 'components/CaratulaAlumno.php';
      $alumnos = $db->getAlumnos();
      foreach($alumnos as $alumno){
        echo '
        <div class="alumno" onclick="location=';
        echo $dir;
        echo'">
          <span>' .$alumno['Apellidos'] .', ' .$alumno['Nombres'] . '</span>
          <span>' .$alumno['DNI'] .'</span>
          <span>' .$alumno['Facultad'] .'</span>
          <span>' .$alumno['Carrera'] .'</span>
        </div>';
      }
      ?>
    </div>
</body>