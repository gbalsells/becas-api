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
      <div id="btn-excel">
      <button class="button registrarse" style="margin-top:30px; margin-bottom: 20px;margin-left: auto; margin-right: auto;" onclick="location=`components/Calculo.php`">Fin de Excel</button>
        <button class="button registrarse" style="margin-top:30px; margin-bottom: 20px;margin-left: auto; margin-right: auto;" onclick="location=`components/excel.php`">Descargar Excel</button>
      </div>
      <div id="form-busqueda">
        <form action="" method="POST">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar alumno">
          <input type="submit" value="BUSCAR" id="btn-busqueda">
        </form>
      </div>
  
      <?php
      include_once 'models/db.php';
      $db = new DB();

      if(isset($_POST['busqueda'])){
        $busqueda = strtolower($_POST['busqueda']);
        if($busqueda == ''){
          $alumnos = $db->getAlumnos();
          foreach($alumnos as $alumno){
            $id = $alumno['idUsuario'];
            echo '
            <div class="alumno" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
              <span>' .$alumno['Apellidos'] .', ' .$alumno['Nombres'] . '</span>
              <span>' .$alumno['DNI'] .'</span>
              <span>' .$alumno['Facultad'] .'</span>
              <span>' .$alumno['Carrera'] .'</span>
            </div>
            ';
          }

        }
        else {
          $alumnos_buscados = $db->buscarAlumno($busqueda);
          if($alumnos_buscados->rowCount()){
            foreach($alumnos_buscados as $alumno){
              $id = $alumno['idUsuario'];
              echo '
              <div class="alumno" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
                <span>' .$alumno['Apellidos'] .', ' .$alumno['Nombres'] . '</span>
                <span>' .$alumno['DNI'] .'</span>
                <span>' .$alumno['Facultad'] .'</span>
                <span>' .$alumno['Carrera'] .'</span>
              </div>
              ';
            }
          } else {
              echo "<div class='incorrecto'>No se han obtenido resultados para la búsqueda.</div>";
          }
        }
      } 
      else {
        $alumnos = $db->getAlumnos();
        foreach($alumnos as $alumno){
          $id = $alumno['idUsuario'];
          echo '
          <div class="alumno" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
            <span>' .$alumno['Apellidos'] .', ' .$alumno['Nombres'] . '</span>
            <span>' .$alumno['DNI'] .'</span>
            <span>' .$alumno['Facultad'] .'</span>
            <span>' .$alumno['Carrera'] .'</span>
          </div>
          ';
        }
      }

      ?>
    </div>
</body>