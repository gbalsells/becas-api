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
      <div class="alumno">
        <span>Balsells, Guido Alejandro</span>
        <span>39142069</span>
        <span>Facultad de Ciencias Exactas y Tecnología</span>
        <span>Ingeniería en Computación</span>
      </div>

      <div class="alumno">
          <span>Balsells, Guido Alejandro</span>
          <span>39142069</span>
          <span>Facultad de Ciencias Exactas y Tecnología</span>
          <span>Ingeniería en Instrumentación de vientos destinados al choto más largo que te pueda llegar a entrar en la garganta la concha puta de tu santa madre</span>
        </div>

        <div class="alumno">
            <span>Balsells, Guido Alejandro</span>
              <span>39142069</span>
              <span>Facultad de Ciencias Exactas y Tecnología</span>
              <span>Ingeniería en Computación</span>
          </div>
    </div>
</body>