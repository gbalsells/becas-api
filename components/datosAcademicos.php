<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - Becas UNT</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
  <?php
    include_once 'constants/facultadesCarreras.php';
    include_once 'models/alumno.php';
    $alumno = new Alumno();
    $id = $user->getIdUsuario();
    $esBecaConectar = $user->getBeca();
    if($esBecaConectar === 1) {
      $hayAlumno = $user->hayAlumnoConectar();
    } else {
      $hayAlumno = $user->hayAlumno();
    }

    if($hayAlumno === 0){
      include_once 'components/CaratulaAlumno.php';
    } else if ($hayAlumno === 1) {
      include_once 'components/datosFamiliares.php';
    } else {
      // Cuando cierre la convocatoria:
      // include_once 'components/solicitudEnviada.php';
      if (isset($_POST['facultad']) && !isset($_POST['carrera'])){
        $facultad = $_POST['facultad'];
        foreach ($facultades as &$fac){
          if ($fac->getNombre() === $_POST['facultad']){
            $carreras = $fac->getCarreras();
          }
        };
        echo '
          <form action="" method="POST" class="registro">
            <h2>Completar Datos Académicos</h2>
            <div class="registro__form">
            <select name="facultad" style="display:none;">';
              echo '<option value="' .$facultad .'">' .$facultad .'</option>';
            echo
            '</select>
            <p>Carrera <br>
                <select name="carrera">';
                  foreach ($carreras as &$carr){
                    echo '<option value="' .$carr .'">' .$carr .'</option>';
                  };
              echo '</select>
              </p>
              <p>Año de ingreso a la facultad: <br>
                <input type="number" name="ingreso">
              </p>
              <p style="display: none;">Duración de la carrera en años: <br>
                <input type="number" name="aniosCarrera">
              </p>
              <p style="font-weight: bold;">
                  Nombre de las materias que cursa actualmente en modalidad virtual:
              </p>';
              for ($i = 1; $i <= 6; $i++) {
                echo '<p>Materia ' .$i .': <br>
                  <input name="materias[]">
                </p>';
              };
              echo '
              <div class="registro__button">
                <input type="submit" value="Siguiente" class="button">
              </div>
            </div>
          </form>';
      } else if (isset($_POST['carrera']) && isset($_POST['materias']) && isset($_POST['ingreso']) && isset($_POST['aniosCarrera'])) {
        $materiasUppercase=array_map(function($word) { return ucwords(strtolower($word)); }, $_POST['materias']);
        $materias = implode(", ",array_unique(array_filter($materiasUppercase)));
        if ($materias !== '' && $_POST['ingreso'] !== 0 && $_POST['ingreso'] !== '' && $_POST['ingreso'] < 2020){
          $carrera = $_POST['carrera'];
          $aniosCarrera = $_POST['aniosCarrera'];
          $facultadAlumno = $_POST['facultad'];
          $ingreso = $_POST['ingreso'];
          if ($esBecaConectar === 1) {
            $alumno->datosAcademicosConectar($id, $facultadAlumno, $carrera, $aniosCarrera, $materias);
          } else {
            $alumno->datosAcademicos($id, $facultadAlumno, $carrera, $aniosCarrera, $materias, $ingreso);
          }
          include_once 'components/datosFamiliares.php';
        } else {
          $facultad = $_POST['facultad'];
          foreach ($facultades as &$fac){
            if ($fac->getNombre() === $_POST['facultad']){
              $carreras = $fac->getCarreras();
            }
          };
          echo '
          <form action="" method="POST" class="registro">';
              if ($materias === ''){
                echo '<div class="incorrecto" style="padding-left: 0px;">Debe ingresar al menos una materia</div>';
              }
              if ($_POST['ingreso'] === '' || $_POST['ingreso'] === 0){
                echo '<div class="incorrecto" style="padding-left: 0px;">Debe indicar en qué año ingresó a la Universidad</div>';
              }
              if ($_POST['ingreso'] === 2020 || $_POST['ingreso'] === '2020'){
                echo '<div class="incorrecto" style="padding-left: 0px;">No puede postularse si ingresó este año a la Universidad</div>';
              }
              echo '
              <h2>Completar Datos Académicos</h2>
              <div class="registro__form">
              <select name="facultad" style="display:none;">';
                echo '<option value="' .$facultad .'">' .$facultad .'</option>';
              echo
              '</select>
              <p>Carrera <br>
                  <select name="carrera">';
                    foreach ($carreras as &$carr){
                      echo '<option value="' .$carr .'">' .$carr .'</option>';
                    };
                echo '</select>
                </p>
                <p>Año de ingreso a la facultad: <br>
                  <input type="number" name="ingreso">
                </p>
                <p style="display: none;">Duración de la carrera en años: <br>
                  <input type="number" name="aniosCarrera">
                </p>
                <p style="font-weight: bold;">
                    Nombre de las materias que cursa actualmente en modalidad virtual:
                </p>';
                for ($i = 1; $i <= 6; $i++) {
                  echo '<p>Materia ' .$i .': <br>
                    <input name="materias[]">
                  </p>';
                };
                echo '
                <div class="registro__button">
                  <input type="submit" value="Siguiente" class="button">
                </div>
              </div>
            </form>';
        }
      } else {
        echo '
        <form action="" method="POST" class="registro">
          <h2>Completar Datos Académicos</h2>
          <div class="registro__form">
            <p>Seleccione su facultad <br>
              <select name="facultad">';
              foreach ($facultades as &$fac){
                echo '<option value="' .$fac->getNombre() .'">' .$fac->getNombre() .'</option>';
              };
              echo
              '</select>
            </p>
            <div class="registro__button">
              <input type="submit" value="Siguiente" class="button">
            </div>
          </div>
        </form>';
      }
    }
  ?>
</body>
</html>