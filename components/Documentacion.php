<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Alumno - Becas Juan B. Teran</title>
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
<div class="adjuntar">
    <h2>Documentación adjuntada por
    <?php
    echo $alumnoDecoded['apellido'] .', ' .$alumnoDecoded['nombre'];
    ?>
    </h2>
    <div>
        <?php
            if ($user->getTipoUsuario() === 0) {
                $carpetaAlumno = "../files/" . $alumnoDecoded['usuario'];
            } else {
                $carpetaAlumno = "../files/" . $user->getUsuario();
            }
            $destino = $carpetaAlumno;
            $documentos = $alumno->listaDocumentacion($id);
            echo '<ul>';
            foreach($documentos as $documento){
                $nombre = $documento["Nombre"];
                echo '
                    <li class="document-link correcto" onclick="location=`VerDocumento.php?path=' .$carpetaAlumno .'&id=' .$id .'`">' .$nombre .'</li>';
            };
            echo '</ul>';
        ?>
    </div>
    <?php
    if ($user->getTipoUsuario() === 0) {
        echo '<a class="button registrarse" style="margin-top: 20px" href="javascript:history.go(-1);">Atras</a>';
    } else {
        echo '<a class="button registrarse" onclick="location=`../index.php`">Atras</a>';
    }
    ?>
</div>