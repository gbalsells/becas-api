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
      <div onclick="location='../index.php'" class="titulo" >Becas Juan B Terán</div>
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
          <input type="password" name="password2">
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
      <p class="registro__tel">Teléfono: <br>
        <input type="tel" name="telefono">
      </p>
      <div class="registro__button">
        <input type="submit" value="Registrarse" class="button">
      </div>
    </div>
  </form>
</body>
</html>

<?php
  include_once '../models/user.php';
  include_once '../models/user_session.php';

  $userSession = new UserSession();
  $newUser = new User();
  
if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['email'])){
  if ($_POST['usuario'] === '' || $_POST['password'] === '' && $_POST['nombres'] === '' && $_POST['apellidos'] === '' && $_POST['dni'] === '' && $_POST['email'] === ''){
    echo '<span class="incorrecto" style="margin-left: 50px; margin-top: 0px;"><span class="incorrecto" style="margin-left: 50px; margin-top: 0px;">Debe ingresar todos los datos</span></span>';
  } elseif ($_POST['password'] === $_POST['password2']){
    $apellidos = $_POST['apellidos'];
    $nombres = $_POST['nombres'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $user = $_POST['usuario'];
    $pass = $_POST['password'];
    $telefono = $_POST['telefono'];
    $md5pass = md5($pass);
    
    $newUser->createUser($apellidos, $nombres, $email, $dni, $md5pass, $user, $telefono);
    header("Location: ../components/registroCompleto.php");
  } else {
    echo 'PASSWORDS DISTINTAS';
  }
}
?>