<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Alumno - Becas UNT</title>
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
        $esBecaConectar = $user->getBeca();
    }

    if (isset($_SESSION['alumno'])){
        $alumnoSession = $_SESSION['alumno'];
        $alumnoDecoded = json_decode($alumnoSession, true);
        $id = $alumnoDecoded['idAlumno'];
    } else {
        header("Location: ../index.php");
    }

    $alumno = new Alumno();

    if($esBecaConectar) {
        $alumno->setAlumnoByUserConectar($alumnoSession);
    } else {
        $alumno->setAlumnoByUserTeran($alumnoSession);
    }?>
<nav class="top-bar">
    Bienvenido/a, <?php echo $user->getNombre(); ?>
    <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
</nav>
<?php
    if (isset($_REQUEST['path']) && isset($_REQUEST['id'])) {
        $path = "../files/" .$_REQUEST['path'];
        $carpetaAlumno = $_REQUEST['path'];
        $documentPath = $path .'/' .$alumnoDecoded['dni'] .'.pdf';
        $idParam = $_REQUEST['id'];
        if ($user->getTipoUsuario() !== 0) {
            if($idParam - $id === 0) {
                echo '<iframe src="' .$documentPath .'" ></iframe> <a class="button registrarse"onclick="location=`Documentacion.php`">Atras</a>';
                if(!$esBecaConectar){
                    echo '<a class="button registrarse" style="background-color: #b71c1c; margin-left: 20px;" onclick="location=`EliminarDocumentacion.php?path=' .$carpetaAlumno .'&id=' .$id .'`">Eliminar</a>';
                }
            } else {
                echo '<h4>Prohibido maquinola</h4>
                <img src="https://media.tenor.com/images/de5a894861f9b4fcee484bdc1b6f5993/tenor.gif"/>';
            }
        } else {
            echo '<iframe src="' .$documentPath .'" ></iframe> <a class="button registrarse" href="javascript:history.go(-1);">Atras</a>';
                echo '<a class="button registrarse" style="background-color: #b71c1c; margin-left: 20px;" onclick="location=`EliminarDocumentacion.php?path=' .$carpetaAlumno .'&id=' .$id .'`">Eliminar</a>';
        }
    }
?>
</body>
