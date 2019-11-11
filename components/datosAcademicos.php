<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sesiones</title>
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
  <?php
    include_once 'constants/facultadesCarreras.php';
    include_once 'models/alumno.php';
    $alumno = new Alumno();
    $id = $user->getIdUsuario();
    $hayAlumno = $user->hayAlumno();

    if($hayAlumno === 0){
      include_once 'components/CaratulaAlumno.php';
    } else if ($hayAlumno === 1) {
      include_once 'components/datosFamiliares.php';
    } else {
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
              <p>Promedio: <br>
                <input type="number" step="0.01" name="promedio">
              </p>
              <p>Cantidad de materias aprobadas en el último ciclo lectivo: <br>
                <input type="number" name="aprobadas">
              </p>
              <p>Cantidad de materias de la carrera: <br>
                <input type="number" name="totales">
              </p>
              <p>Cantidad de examenes rendidos en total: <br>
                <input type="number" name="rendidos">
              </p>
              <div class="registro__button">
                <input type="submit" value="Siguiente" class="button">
              </div>
            </div>
          </form>';
      } else if (isset($_POST['carrera']) && isset($_POST['ingreso']) && isset($_POST['promedio']) && isset($_POST['aprobadas']) && isset($_POST['totales']) && isset($_POST['rendidos'])){
        if ($_POST['carrera'] !== '' || $_POST['ingreso'] !== '' || $_POST['promedio'] !== '' || $_POST['aprobadas'] !== '' || $_POST['totales'] !== '' || $_POST['rendidos'] !== ''){
          if ($_POST['promedio'] > 10 || $_POST['aprobadas'] > $_POST['rendidos'] || $_POST['aprobadas'] > $_POST['totales'] || $_POST['rendidos'] > $_POST['totales'] || $_POST['ingreso'] > 2019) {
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
                <p>Promedio: <br>
                  <input type="number" step="0.01" name="promedio">
                </p>
                <p>Cantidad de materias aprobadas en el último ciclo lectivo: <br>
                  <input type="number" name="aprobadas">
                </p>
                <p>Cantidad de materias de la carrera: <br>
                  <input type="number" name="totales">
                </p>
                <p>Cantidad de examenes rendidos en total: <br>
                  <input type="number" name="rendidos">
                </p>
                <div class="registro__button">
                  <input type="submit" value="Siguiente" class="button">
                </div>
              </div>
            </form>';
            echo '<div class="incorrecto" style="margin-left: 50px;">Error en los datos ingresados. Por favor, Intente nuevamente.</div>';
          } else {
            $carrera = $_POST['carrera'];
            $ingreso = $_POST['ingreso'];
            $promedio = $_POST['promedio'];
            $aprobadas = $_POST['aprobadas'];
            $totales = $_POST['totales'];
            $rendidos = $_POST['rendidos'];
            $facultadAlumno = $_POST['facultad'];
            $alumno->datosAcademicos($id, $facultadAlumno, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos);
            include_once 'components/datosFamiliares.php';
          }
        } else {
            echo 'Debe ingresar todos los datos';
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