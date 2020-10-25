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
<div class="adjuntar">
    <h2>Adjuntar PDF</h2>
    <h3>A continuación, puede adjuntar la documentación requerida. </h3>
    <p style="font-size: 16px;">Se permite:
        <ul>
            <li>Sólo un archivo por alumno</li>
            <li>Archivos únicamente en formato PDF</li>
            <li>El archivo debe pesar menos de 1MB</li>
        </ul>    
    </p>
    <div style="font-style: italic;">
        <p >Sugerencias: 
            <ul>
                <li>Puede utilizar apps para combinar todas sus imágenes en un único PDF </li>
                <li>Verifique que todas las imágenes tengan la misma orientación</li>
                <li>Si su archivo es mayor a 1MB, deberá comprimirlo</li>
            </ul>
        </p>
    </div>
    <form method="post" action="" enctype="multipart/form-data">
        <p class="document-form">Archivo: <br>
            <input type="file" name="archivo" class="document-input">
        </p>
        <div class="editar__buttons">
            <input type="submit" value="Subir" name="subir" class="button">
            <?php
                if ($user->getTipoUsuario() === 0) {
                    echo '<a class="button registrarse" style="margin-top: 20px" onclick="location=`CaratulaAlumno.php?id=' .$id .'`">Volver</a>';
                } else {
                    echo '<a class="button registrarse" onclick="location=`../index.php`">Volver</a>';
                }
            ?>
        </div>
    </form>            
    <?php
        if (isset($_POST['subir'])) {
            $nombre = $alumnoDecoded['dni'] .'.pdf';
            $tipo = $_FILES['archivo']['type'];
            $tamanio = $_FILES['archivo']['size'];
            $ruta = $_FILES['archivo']['tmp_name'];
            if ($user->getTipoUsuario() === 0) {
                $carpetaAlumno = "../files/" . $alumnoDecoded['usuario'];
            } else {
                $carpetaAlumno = "../files/" . $user->getUsuario();
            }
            $destino = $carpetaAlumno .'/' . $nombre;
            if ($nombre !== '') {
                if ($tipo === 'application/pdf' && $tamanio < 1000000) {
                    if(!is_dir($carpetaAlumno)){
                        $crear = mkdir($carpetaAlumno, 0777, true);
                    }
                    if (copy($ruta, $destino)) {
                        $resultado = $alumno->adjuntarPDF($id, $nombre, $tamanio);
                        if ($resultado) {
                            echo '<span class="incorrecto adjunto-incorrecto">Sólo se permite adjuntar un único archivo PDF.</span>';
                        } else {
                            echo '<span class="correcto">Archivo subido con éxito</span>';
                        }
                    } else {
                        echo '<span class="incorrecto adjunto-incorrecto">Error al adjuntar archivo.</span>';
                    }        
                } else {
                    echo '<span class="incorrecto adjunto-incorrecto">No se puede subir un documento que no sea de extensión PDF ni que pese más de 1MB.</span>';
                }
            }
        }
    ?>
</div>