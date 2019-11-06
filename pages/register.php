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
      <div><img src="../assets/sae.jpg" /></div>
      <div onclick="location='../index.php'" class="titulo" >Becas Juan B Terán</div>
      <div><img src="../assets/unt.jpg" /></div>
  </nav>
  <form action="" method="POST" class="registro">
    <h2>Registrarse</h2>
    <div class="registro__form">
      <p class="registro__user">Nombre de usuario: <br>
        <input type="text" name="usuario">
      </p>

      <div class="registro__flex">
        <p>Contraseña: <br>
          <input type="password" name="password">
        </p>
        <p>Repetir contraseña: <br>
          <input type="password" name="password">
        </p>
      </div>
      <div class="registro__flex">
        <p>Apellidos: <br>
          <input type="text" name="apellidos">
        </p>
        <p>Nombres: <br>
          <input type="text" name="nombres">
        </p>
      </div>
      <p>DNI: <br>
        <input type="number" name="dni">
      </p>
      <p>Email: <br>
        <input type="email" name="email">
      </p>
      <p class="registro__tel">Telefono: <br>
        <input type="tel" name="telefono">
      </p>
      <div class="registro__button">
        <input type="submit" value="Registrarse" class="button">
      </div>
    </div>
  </form>
</body>
</html>