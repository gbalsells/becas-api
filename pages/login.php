<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Becas Juan B. Teran</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <nav class="top-bar">
        <div class="top-bar__unt">
          <img src="assets/untletras.png" alt="" style="padding:10px;">          
        </div>
        <a onclick="location='index.php'" class="titulo">Becas Juan B Terán</a>
        <div class="top-bar__organismos">
          <span>Secretaría de Asuntos Estudiantiles</span>
          <span>Dirección General de Becas</span>
        </div>
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
            <p>Nombre de usuario o DNI: <br>
              <input type="text" name="usuario" class="login__input">
            </p>
            <p>Password: <br>
              <input type="password" name="password" class="login__input">
            </p>
            <div class="login__buttons">
              <input type="submit" value="Iniciar Sesión" class="button">
              <input onclick="location='./pages/register.php'" type="button" value="Registrarse" class="button registrarse">
            </div>
            <!--
            MENSAJE PARA CUANDO CIERRE LA CONVOCATORIA
            <div id="mensaje-recordatorio">
              <p id="atencion"><b>¡ATENCIÓN!</b></p>
              <p id="recordar">La convocatoria ha cerrado. Puede ingresar para consultar el estado de su solicitud.</p>
            </div>
            -->
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