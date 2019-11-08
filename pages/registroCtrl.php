<?php
    include_once 'models/user_session.php';
    include_once 'models/user.php';
    $userSession = new UserSession();
    $user = new User();
    $incorrecto = false;
    if (isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser($user));
        include_once 'pages/home.php';
    } else if (isset($_POST['usuario']) && isset($_POST['password'])){
        if (isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['email'])){
          if ($_POST['usuario'] === '' || $_POST['password'] === '' && $_POST['nombres'] === '' && $_POST['apellidos'] === '' && $_POST['dni'] === '' && $_POST['email'] === ''){
            echo 'Debe ingresar todos los datos';
          } elseif ($_POST['password'] === $_POST['password2']){
            $apellidos = $_POST['apellidos'];
            $nombres = $_POST['nombres'];
            $email = $_POST['email'];
            $dni = $_POST['dni'];
            $usuario = $_POST['usuario'];
            $pass = $_POST['password'];
            $telefono = $_POST['telefono'];
            $md5pass = md5($pass);
            
            $user->createUser($apellidos, $nombres, $email, $dni, $md5pass, $usuario, $telefono);
            $userSession->setCurrentUser($usuario);
            $user->setUser($usuario);
            $logear = true;
            include_once 'pages/home.php';
          } else {
            echo 'PASSWORDS DISTINTAS';
          }
        }
    } else {
        include_once 'pages/register.php';
    }
  
?>