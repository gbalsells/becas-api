<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - Becas UNT</title>
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main.css">
  </head>
  <body>
    <!--
      Mensaje para desactivar registro:
      <h2 style="margin-left: 20px;">Página no encontrada</h2>
    -->
    <?php
    include_once '../models/user.php';
    include_once '../models/user_session.php';
    
    $userSession = new UserSession();
    $newUser = new User();
    
    if (isset($_POST['becaConectar'])) {
      $becaConectar = $_POST['becaConectar'];
      if ($_POST['becaConectar'] === '0') {
        $beca = 'Juan B. Terán';
      } else {
        $beca = 'Conectividad';
      }
      echo '
      <nav class="top-bar logos">
        <div class="top-bar__unt">
          <img src="../assets/unt.png" alt="" style="padding:10px;">          
        </div>
        <a onclick="location=`../index.php`" class="titulo">Becas ' .$beca .' - UNT</a>
        <div class="top-bar__organismos">
          <img src="../assets/sae3.png" alt="" style="padding:10px;">          
        </div>
      </nav>
      <form action="" method="POST" class="registro inicio">';
      if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['domicilio']) && isset($_POST['localidad']) && isset($_POST['provincia'])){
        if ($_POST['usuario'] === '' || $_POST['password'] === '' || $_POST['nombres'] === '' || $_POST['apellidos'] === '' || $_POST['dni'] === '' || $_POST['dni'] < 10000000 || $_POST['email'] === '' || $_POST['domicilio'] === '' || $_POST['localidad'] === '' || $_POST['provincia'] === ''){
          if ($_POST['dni'] < 10000000) {
            echo '<span class="incorrecto" margin-top: 0px;">DNI inválido</span>';
          } else {
            echo '<span class="incorrecto" margin-top: 0px;">Debe ingresar todos los datos</span>';
          }
        } elseif ($_POST['password'] === $_POST['password2']){
          $apellidos = $_POST['apellidos'];
          $nombres = $_POST['nombres'];
          $email = $_POST['email'];
          $dni = $_POST['dni'];
          $user = $_POST['usuario'];
          $pass = $_POST['password'];
          $telefono = $_POST['telefono'];
          $domicilio = $_POST['domicilio'];
          $localidad = $_POST['localidad'];
          $provincia = $_POST['provincia'];
          $becaConectar = $_POST['becaConectar'];
    
          $md5pass = md5($pass);
          $nuevoUsuario = $newUser->createUser($apellidos, $nombres, $email, $dni, $md5pass, $user, $telefono, $becaConectar, $domicilio, $localidad, $provincia);
          if ($nuevoUsuario === NULL) {
            $location = 'Location: ../components/registroCompleto.php?beca=' .$becaConectar;
            header($location);
          } else {
            echo '<span class="incorrecto">' .$nuevoUsuario.'</span>';
          }
        } else {
          echo '<span class="incorrecto">Las contraseñas ingresadas no coinciden. Por favor inténtelo nuevamente.</span>';
        }
      }
      echo '
        <select name="becaConectar" style="display:none;">';
        echo '<option value="' .$becaConectar .'">' .$becaConectar .'</option>';
        echo
        '</select>
        <h2>Inscripción a la beca ' .$beca .'</h2>
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
          <p> Lugar donde reside en época de aislamiento/distanciamiento social preventivo obligatorio: </p>
          <div class="domicilio">
            <p>
              Domicilio (Calle, Número, Piso, Departamento): <br>
              <input type="text" name="domicilio">
            </p>
            <p>
              Localidad: <br>
              <input type="text" name="localidad">
            </p>
            <p>
              Provincia: <br>
              <input type="text" name="provincia">
            </p>
          </div>
          <p>Email: <br>
            <input type="email" name="email">
          </p>
          <p class="registro__tel">Número de celular (Sin 0 ni 15): <br>
            <input type="tel" name="telefono">
          </p>
          <div class="registro__button" style="padding-bottom: 20px;">
            <input type="submit" value="Registrarse" class="button">
            <a class="button registrarse" style="margin-top: 20px" href="javascript:history.go(-1);">Atras</a>
            <a class="button registrarse" style="margin-top: 20px"  onclick="location=`../index.php`">Cancelar</a>
          </div>
        </div>
      </form>
      ';
    } else {
      echo '
      <nav class="top-bar logos">
        <div class="top-bar__unt">
          <img src="../assets/unt.png" alt="" style="padding:10px;">          
        </div>
        <a onclick="location=`../index.php`" class="titulo">Becas UNT</a>
        <div class="top-bar__organismos">
          <img src="../assets/sae3.png" alt="" style="padding:10px;">          
        </div>
      </nav>
      <form action="" method="POST" class="tipoBeca">
        <div class="tipoBeca__card">
          <h2>Bienvenido/a</h2>
          <h3>¿Para qué beca desea postularse?</h3>
          <div class="tipoBeca__options">
            <div class="tipoBeca__radio">
              <input type="radio" name="becaConectar" value="0" disabled>
              <label for="0">Becas J.B.Teran</label><br>
            </div>
            <div class="tipoBeca__radio">
              <input type="radio" name="becaConectar" value="1" checked>
              <label for="1">Becas Conectividad</label><br>
            </div>
          </div>
          <div class="registro__button" style="padding-bottom: 20px;">
            <input type="submit" value="Continuar" class="button">
          </div>
        </div>
      </form>
      ';
    }
  ?>
</body>
</html>
