<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar estado de alumno - Becas UNT</title>
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
    $alumno = new Alumno();

    if (isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser($user));
        $esBecaConectar = $user->getBeca();
    }

    if (isset($_SESSION['alumno'])){
        $alumnoSession = $_SESSION['alumno'];
        $alumnoDecoded = json_decode($alumnoSession, true);
        $id = $alumnoDecoded['idAlumno'];
        $hayBeca = $alumno->esBecaConectar($id);
        $esBecaConectar = $hayBeca["esBecaConectar"];
    } else {
        header("Location: ../index.php");
    }

    if($esBecaConectar === 1) {
        $alumno->setAlumnoByUserConectar($alumnoSession);
    } else {
        $alumno->setAlumnoByUserTeran($alumnoSession);
    }
?>
<nav class="top-bar">
    Bienvenido/a, <?php echo $user->getNombre(); ?>
    <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
</nav>
<?php
if (isset($_POST['estado'])){
    $estado = $_POST['estado'];
    if($esBecaConectar === 1) {
        $alumno->editarEstadoConectar($id, $estado);
    } else {
        $alumno->editarEstado($id, $estado);
    }
    $_SESSION['alumno'] = null;
    header("Location: ../index.php");
} else {
    echo '
    <form action="" method="POST" class="registro">
        <h2>Estado del Alumno ' .$alumnoDecoded['apellido'] .', ' .$alumnoDecoded['nombre'] .'</h2>
        <div class="registro__form">
            <p>
                <select class="select" name="estado">
                    <option value="0">Solicitud enviada</option>
                    <option value="1">Preselección</option>
                    <option value="2">Fuera de concurso (Supera permanencia)</option>
                    <option value="3">Fuera de concurso (Faltan datos)</option>
                    <option value="4">Fuera de concurso (No es usuario registrado)</option>
                </select>
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