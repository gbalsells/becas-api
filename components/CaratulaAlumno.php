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

    $alumno = new Alumno();
    $id = $user->getIdUsuario();

    $alumno->setAlumno($id);
    ?>
    <nav class="top-bar">
        Bienvenido, <?php echo $user->getNombre(); ?>
        <a href="models/logout.php">Cerrar sesión</a>
    </nav>
    <div class="caratula">
        <div class="caratula__contenido">
            <div class="caratula__header">
                <span class="caratula__header__nombre"><?php echo $user->getApellido() .', ' .$user->getNombre(); ?></span>
                <span class="caratula__header__estado">
                    <?php
                    $estado = $alumno->getEstado();
                    if ($estado === null) {
                        echo 'Solicitud enviada';
                    } else if ($estado === 1) {
                        echo 'Aprobada';
                    } else if ($estado === 2) {
                        echo 'Rechazada';
                    }
                     ?>
                    </span>
            </div>
            <div class="caratula__datos">
                <h3>Datos personales</h3>
                <ul class="caratula__datos__info">
                    <li><b>DNI: </b><?php echo $user->getDNI();?></li>
                    <li><b>Email: </b><?php echo $user->getEmail();?></li>
                    <li><b>Telefono: </b><?php echo $user->getTelefono();?></li>
                </ul>
                <h3>Datos académicos</h3>
                <ul class="caratula__datos__info">
                    <li><b>Facultad: </b><?php echo $alumno->getFacultad();?></li>
                    <li><b>Carrera: </b><?php echo $alumno->getCarrera();?></li>
                    <li><b>Cantidad de materias de la carrera: </b><?php echo $alumno->getCantidadMaterias();?></li>
                    <li><b>Año de ingreso a la facultad: </b><?php echo $alumno->getAnioIngreso();?></li>
                    <li><b>Promedio: </b><?php echo $alumno->getPromedio();?></li>
                    <li><b>Materias aprobadas el último ciclo lectivo: </b><?php echo $alumno->getMateriasAprobadas();?></li>
                    <li><b>Cantidad de materias rendidas: </b><?php echo $alumno->getExamenesRendidos();?></li>


                </ul>
                <h3>Datos familiares</h3>
                <ul class="caratula__datos__info">
                    <li><b>Ingresos: </b>$<?php echo $alumno->getIngresos();?></li>
                    <li><b>Egresos: </b>$<?php echo $alumno->getEgresos();?></li>
                    <li><b>Integrantes del grupo familiar: </b><?php echo $alumno->getIntegrantesFamilia();?></li>
                </ul>
            </div>
    </div>
</body>
</html>
