<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud enviada - Becas UNT</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <?php
    include_once '../models/user_session.php';
    require_once '../models/user.php';
    require_once '../models/alumno.php';

    $logout = "../models/logout.php";

    $userSession = new UserSession();
    $user = new User();

    if (isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser($user));
    }
    ?>
    <nav class="top-bar">
        Bienvenido/a, <?php echo $user->getNombre(); ?>
        <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
    </nav>
    <div class="solicitud__background">

    <!-- <form action="" method="POST" class="solicitud__text">
        <h2>Solicitar Beca Juan B. Terán</h2>
        <p>Para continuar, deberá <span style="font-weight: bold; color:red;" >completar el formulario de registro </span>.</p>
        <p>¿Está seguro que desea postularse para la Beca Juan B. Terán?</p>
        <p>Su postulación para la Beca Conectividad seguirá en curso y los datos ingresados a este fin <b>no serán modificados ni borrados</b></p>
        <select name="vulnerabilidad" style="display:none;">
            <option value="solicitar"> True</option>
        </select>
        <select name="aceptar" style="display:none;">
            <option value="aceptar">true</option>
        </select>
        <div class="registro__button" style="margin-bottom: 20px;">
            <input type="submit" value="aceptar" class="button">
            <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
        </div>
    </form> -->
    </div>
    <?php
        if(isset($_POST['aceptar'])) {
            $solicitud = $user->solicitarTeran();
            if($solicitud) {
                header("Location: ../index.php");
            }
        }
    ?>
</body>
</html>

