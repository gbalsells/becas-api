<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sesiones</title>
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <nav class="top-bar">
      <div><img src="../assets/sae.jpg" /></div>
      <div>Becas Juan B Terán</div>
      <div><img src="../assets/unt.jpg" /></div>
    </nav>
    <div class="login-div">
      <form action="" method="POST" class="login">
          <?php|
              if(isset($errorLogin)){
                  echo $errorLogin;
              }
          ?>
          <div class="login__form">
            <h2>Iniciar sesión</h2>
            <p>Nombre de usuario: <br>
              <input type="text" name="usuario" class="login__input">
            </p>
            <p>Password: <br>
              <input type="password" name="password" class="login__input">
            </p>
            <div class="login__buttons">
              <p class="center"><input type="submit" value="Iniciar Sesión" class="button"></p>
              <p class="center"><input onclick="location='./pages/register.php'" type="button" value="Registrarse" class="button registrarse"></p>
            </div>
          </div>
      </form>
    </div>
</body>
</html>