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
        Bienvenido, <?php echo $user->getNombre(); ?>
        <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
    </nav>
    <div class="solicitud__background">
        <div class="solicitud__text">
            <h2>¡Su solicitud fue enviada exitosamente!</h2>
            <p>A partir de ahora, puede acceder al sistema con su usuario y contraseña para ver el resumen y estado de su solicitud. </p>
            <p>Para ver su solicitud ahora, haga click <a class="link" onclick="location='../index.php'">aquí</a></p>
        </div>
    </div>
</body>
</html>