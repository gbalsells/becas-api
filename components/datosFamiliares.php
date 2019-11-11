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
include_once 'models/alumno.php';
$alumno = new Alumno();
$id = $user->getIdUsuario();
echo '
<form action="" method="POST" class="registro">
  <h2>Datos Familiares</h2>
  <div class="registro__form familiares">
    <p>Ingresos totales en pesos (Sumatoria de los ingresos económicos de todos los integrantes del grupo familiar): <br>
      <input type="number" name="ingresos">
    </p>
    <p>Egresos totales en pesos (Sumatoria de los servicios, impuestos y créditos del grupo familiar):  <br>
      <input type="number" name="egresos">
    </p>
    <p>Cantidad de integrantes de su grupo familiar (No debe contarse a usted mismo): <br>
      <input type="number" name="integrantes">
    </p>
    <div class="registro__button">
      <input type="submit" value="Siguiente" class="button">
    </div>
  </div>
</form>';
if (isset($_POST['ingresos']) && !isset($_POST['egresos']) && !isset($_POST['integrantes'])){
  echo 'Uretra';
  $ingresos = $_POST['ingresos'];
  $egresos = $_POST['egresos'];
  $integrantes = $_POST['integrantes'];
  $alumno->datosFamiliares($id, $ingresos, $egresos, $integrantes);
  include_once 'components/caratulaAlumno.php';
}
?>
  
</body>
</html>
