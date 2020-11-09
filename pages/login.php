<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Becas UNT</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <nav class="top-bar logos">
        <div class="top-bar__unt">
          <img src="assets/unt.png" alt="" style="padding:10px;">          
        </div>
        <a onclick="location='index.php'" class="titulo">Becas UNT</a>
        <div class="top-bar__organismos">
          <img src="assets/sae3.png" alt="" style="padding:10px;">          
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
            <div>
            <!--
            MENSAJE PARA CUANDO CIERRE LA CONVOCATORIA
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
    <div class="login">
      <div class="login__form message">
        <div id="mensaje-recordatorio">
          <p id="atencion"><b>¡ATENCIÓN!</b></p>
          <ul>
            <li>La convocatoria para las becas <b>Conectividad</b> ha cerrado. Puede ingresar para consultar el estado de su solicitud.</li>
            <li>Se encuentran abiertas las inscripciones para la <b>Beca J. B. Terán</b></li>
            <li>Si ya se encuentra inscripto a las becas Conectividad y desea postularse para las becas Juan B. Terán, <b>inicie sesión</b> y seleccione la opción <b>"Solicitar Beca J. B. Terán"</b></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>
</html>