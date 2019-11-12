<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Becas Juan B. Teran</title>

    <link rel="stylesheet" href="../main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <nav class="top-bar">
        <a onclick="location='index.php'" class="titulo">Becas Juan B Terán</a>
    </nav>
    <div class="login-div">
      <form action="" method="POST" class="login">
          <?php
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
              <input type="submit" value="Iniciar Sesión" class="button">
              <input onclick="location='./pages/register.php'" type="button" value="Registrarse" class="button registrarse">
            </div>
            <?php
            if($incorrecto === true){
              echo '
              <div class="incorrecto">
                Usuario y/o contraseña incorrecta
              </div>
              ';
            }
            ?>
          </div>
      </form>
    </div>
</body>
</html>