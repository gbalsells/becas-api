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
    <h2>Completar Datos Académicos</h2>
    <div class="registro__form">
      <p>Facultad <br>
        <select name="facultad">
          <option value="volvo">Fac1</option>
          <option value="saab">Fac2</option>
          <option value="mercedes">Fac3</option>
          <option value="audi">Fac4</option>
        </select>
      </p>
      <p>Carrera <br>
        <select name="carrera">
          <option value="volvo">Carr1</option>
          <option value="saab">Carr2</option>
          <option value="mercedes">Carr3</option>
          <option value="audi">Carr4</option>
        </select>
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
  </form>
</body>
</html>