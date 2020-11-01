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
    include_once '../models/facultad.php';
    include_once '../constants/facultadesCarreras.php';
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
    }
?>
<nav class="top-bar">
    Bienvenido/a, <?php echo $user->getNombre(); ?>
    <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
</nav>
<div>
<?php
    if (isset($_REQUEST['path']) && isset($_REQUEST['id'])) {
        $path = $_REQUEST['path'];
        $idParam = $_REQUEST['id'];
        $documentPath = $path .'/' .$alumnoDecoded['dni'] .'.pdf';
        if ($user->getTipoUsuario() !== 0) {
            if($idParam - $id === 0) {
                echo '
                <div class="solicitud__background">
                    <form action="" method="POST">
                        <div class="editar__warning">
                            <select name="aceptar" style="display:none;">
                                <option value="aceptar">true</option>
                            </select>
                            <h2>¿Confirma que desea eliminar la documentación adjuntada?</h2>
                            <p class="editar__p">Luego podrá adjuntar nueva documentación.</p>
                            <div class="editar__buttons">
                                <input type="submit" value="Continuar" class="button"/>
                                <a class="button registrarse" onclick="location=`Documentacion.php`">Atras</a>
                            </div>
                    </div>
                </form>
                ';
            } else {
                echo '<h4>Prohibido maquinola</h4>
                <img src="https://media.tenor.com/images/de5a894861f9b4fcee484bdc1b6f5993/tenor.gif"/>';
            }
        } else {
            echo '
            <div class="solicitud__background">
                <form action="" method="POST">
                    <div class="editar__warning">
                        <select name="aceptar" style="display:none;">
                            <option value="aceptar">true</option>
                        </select>
                        <h2>¿Confirma que desea eliminar la documentación adjuntada?</h2>
                        <p class="editar__p">Luego podrá adjuntar nueva documentación.</p>
                        <div class="editar__buttons">
                            <input type="submit" value="Continuar" class="button"/>
                            <a class="button registrarse" onclick="location=`Documentacion.php`">Atras</a>
                        </div>
                </div>
            </form>
            ';
        }
    }
    if (isset($_POST['aceptar'])) {
        $delete = $alumno->eliminarDocumentacion($id);
        if ($delete) {
            unlink($documentPath);
            rmdir($path);
            if ($user->getTipoUsuario() !== 0) {
                header("Location: ../index.php");
            } else {
                $location = 'Location: CaratulaAlumno.php?id=' .$idParam;
                echo $location;
                header($location);
            }
        }
    }

?>
</div>