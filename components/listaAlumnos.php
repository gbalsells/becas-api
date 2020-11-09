<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas UNT</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
    <div class="lista_alumnos">
      <h2>Alumnos registrados:</h2>
      <div id="btn-excel">
        <button class="button lista-teran" style="margin-top:30px; margin-bottom: 20px;margin-left: auto; margin-right: auto;" onclick="location=`components/descargar.php?beca=0`">Descargar Documentación Terán</button>
        <button class="button lista-teran" style="margin-top:30px; margin-bottom: 20px;margin-left: auto; margin-right: auto;" onclick="location=`components/excel.php?beca=0`">Descargar Excel Terán</button>
      </div>
      <div id="btn-excel">
        <button class="button lista-conectividad" style="margin-top:30px; margin-bottom: 20px;margin-left: auto; margin-right: auto;" onclick="location=`components/descargar.php?beca=1`">Descargar Documentación Conectividad</button>
        <button class="button lista-conectividad" style="margin-top:30px; margin-bottom: 20px;margin-left: auto; margin-right: auto;" onclick="location=`components/excel.php?beca=1`">Descargar Excel Conectividad</button>
      </div>
      <div id="form-busqueda">
        <form action="" method="POST">
          <input type="text" name="busqueda" id="busqueda" placeholder="Buscar alumno">
          <input type="submit" value="BUSCAR" id="btn-busqueda">
        </form>
      </div>
      <div style="display: flex; align-items: center;">
      <div class="indicador-teran"></div>Becas Terán
      <div class="indicador-conectar"></div>Becas Conectividad
      </div>
  
      <?php
      include_once 'models/db.php';
      $db = new DB();
      
      function object_sorter($clave,$orden=null) {
        return function ($a, $b) use ($clave,$orden) {
              $result=  ($orden=="DESC") ? strnatcmp($b->$clave, $a->$clave) :  strnatcmp($a->$clave, $b->$clave);
              return $result;
        };
      }

      if(isset($_POST['busqueda'])){
        $busqueda = strtolower($_POST['busqueda']);
        if($busqueda == ''){
          $alumnos1 = $db->getAlumnosConectar()->fetchAll(PDO::FETCH_OBJ);
          $alumnos2 = $db->getAlumnos()->fetchAll(PDO::FETCH_OBJ);
          $alumnos = array_merge($alumnos1, $alumnos2);
          usort($alumnos, object_sorter('FechaCreacion'));
          foreach($alumnos as $alumno){
            $id = $alumno->idUsuario;
            echo '
            <div class="';
            if($alumno->esBecaConectar) {
              echo 'alumno_conectar';
            } else {
              echo 'alumno';
            }
            echo '" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
              <span>' .$alumno->Apellidos .', ' .$alumno->Nombres . '</span>
              <span>' .$alumno->DNI .'</span>
              <span>' .$alumno->Facultad .'</span>
              <span>' .$alumno->Carrera .'</span>
            </div>
            ';
          }

        }
        else {
          $alumnos_buscados1 = $db->buscarAlumnoConectar($busqueda)->fetchAll(PDO::FETCH_OBJ);
          $alumnos_buscados2 = $db->buscarAlumno($busqueda)->fetchAll(PDO::FETCH_OBJ);
          $alumnos_buscados = array_merge($alumnos_buscados1, $alumnos_buscados2);
          usort($alumnos_buscados, object_sorter('FechaCreacion'));
          if(count($alumnos_buscados) > 0){
            foreach($alumnos_buscados as $alumno){
              $id = $alumno->idUsuario;
              echo '
              <div class="';
              if($alumno->esBecaConectar) {
                echo 'alumno_conectar';
              } else {
                echo 'alumno';
              }
              echo '" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
                <span>' .$alumno->Apellidos .', ' .$alumno->Nombres . '</span>
                <span>' .$alumno->DNI .'</span>
                <span>' .$alumno->Facultad .'</span>
                <span>' .$alumno->Carrera .'</span>
              </div>
              ';
            }
          } else {
              echo "<div class='incorrecto'>No se han obtenido resultados para la búsqueda.</div>";
          }
        }
      } 
      else {
        $alumnos1 = $db->getAlumnosConectar()->fetchAll(PDO::FETCH_OBJ);
        $alumnos2 = $db->getAlumnos()->fetchAll(PDO::FETCH_OBJ);
        $alumnos = array_merge($alumnos1, $alumnos2);
        usort($alumnos, object_sorter('FechaCreacion'));
        foreach($alumnos as $alumno){
          $id = $alumno->idUsuario;
          echo '
          <div class="';
          if($alumno->esBecaConectar) {
            echo 'alumno_conectar';
          } else {
            echo 'alumno';
          }
          echo '" onclick="location=`components/CaratulaAlumno.php?id=' .$id .'`">
            <span>' .$alumno->Apellidos .', ' .$alumno->Nombres . '</span>
            <span>' .$alumno->DNI .'</span>
            <span>' .$alumno->Facultad .'</span>
            <span>' .$alumno->Carrera .'</span>
          </div>
          ';
        }
      }

      ?>
    </div>
</body>