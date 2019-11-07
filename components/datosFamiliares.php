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
  <form action="" method="POST" class="registro">
      <h2>Datos Familiares</h2>
      <div class="registro__form">
        <p>Ingresos totales (Sumatoria de los ingresos económicos de todos los integrantes del grupo familiar): <br>
          <input type="number" name="ingresos">
        </p>
        <p>Egresos totales (Sumatoria de los servicios, impuestos y créditos del grupo familiar):  <br>
          <input type="number" name="promedio">
        </p>
        <p>Cantidad de materias aprobadas en el último ciclo lectivo: <br>
          <input type="number" name="aprobadas">
        </p>
        <div class="registro__button">
          <input type="submit" value="Siguiente" class="button">
        </div>
      </div>
    </form>
</body>
</html>