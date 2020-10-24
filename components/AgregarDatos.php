<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar datos - Becas Juan B. Teran</title>
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

    if (isset($_SESSION['alumno'])){
        $alumnoSession = $_SESSION['alumno'];
        $alumnoDecoded = json_decode($alumnoSession, true);
        $id = $alumnoDecoded['idAlumno'];
    } else {
        header("Location: ../index.php");
    }

    if (isset($_SESSION['merito'])){
        $merito = $_SESSION['merito'];
    }

    $alumno = new Alumno();


    $alumno->setAlumnoByUserTeran($alumnoSession);
?>
<nav class="top-bar">
    Bienvenido/a, <?php echo $user->getNombre(); ?>
    <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
</nav>
<?php
if (isset($_POST['vulnerabilidad']) && isset($_POST['distancia'] )){
    $vulnerabilidad = $_POST['vulnerabilidad'];
    $distancia = $_POST['distancia'];
    $alumno->agregarDatos($id, $vulnerabilidad, $distancia, $merito);
    $_SESSION['alumno'] = null;
    header("Location: ../index.php");
} else {
    echo '
    <form action="" method="POST" class="registro">
    <h2>Agregar datos al Alumno ' .$alumnoDecoded['apellido'] .', ' .$alumnoDecoded['nombre'] .'</h2>
    ';
        echo '
        <div class="registro__form">
            <p>Puntos por vulnerabilidad: <br>
                <input type="number" name="vulnerabilidad" value="' .$alumnoDecoded['Vulnerabilidad'] .'">
            </p>
            <p>Puntos por distancia: <br>
                <input type="number" name="distancia" value="' .$alumnoDecoded['Distancia'] .'">
            </p>
            <div class="registro__button">
                <input type="submit" value="Aceptar" class="button">';
                if ($user->getTipoUsuario() === 0) {
                    echo '<a class="button registrarse" style="margin-top: 20px" href="javascript:history.go(-1);">Cancelar</a>';
                } else {
                    echo '<a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>';
                }
            echo '
            </div>
        </div>
    </form>
    ';
}
?>