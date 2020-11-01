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
        <div class="solicitud__text">
        <!--
            <h2 style="color: red;">LA CONVOCATORIA HA CERRADO</h2>
            <p>A partir de ahora, no aceptamos más solicitudes.</p>
        -->
            <h2>¡Su solicitud fue enviada exitosamente!</h2>
            <p>Para continuar, deberá <span style="font-weight: bold; color:red;" >adjuntar la documentación </span> requerida (En el próximo paso se detallarán los documentos necesarios).</p>
            <p>Luego de hacerlo, podrá acceder al sistema con su usuario y contraseña para ver el resumen y estado de su solicitud. </p>
            <p>Puede cerrar sesión y cargar la documentación cuando la tenga disponible. </p>
            <p>Para adjuntar su documentación ahora, haga click <a class="link" onclick="location='../index.php'">aquí</a></p>
        </div>
    </div>
</body>
</html>

