<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas Juan B. Teran</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <?php
    if (isset($_REQUEST['id'])) {
        include_once '../models/user_session.php';
        include_once '../constants/salarioMinimo.php';
        require_once '../models/user.php';
        require_once '../models/alumno.php';

        $id = $_REQUEST['id'];
        $logout = "../models/logout.php";

        $userSession = new UserSession();
        $user = new User();

        if (isset($_SESSION['user'])){
            $user->setUser($userSession->getCurrentUser($user));
        }
    } else {
        $id = $user->getIdUsuario();
        $logout = "models/logout.php";
    }
    $alumno = new Alumno();

    $alumno->setAlumnoByUser($id);
    $alumnoJson = json_encode($alumno);
    ?>
    <nav class="top-bar">
        Bienvenido/a, <?php echo $user->getNombre(); ?>
        <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
    </nav>
    <div class="caratula">
        <div class="caratula__contenido">
            <div class="caratula__header">
                <span class="caratula__header__nombre"><?php echo $alumno->getApellido() .', ' .$alumno->getNombre(); ?></span>
                <span class="caratula__header__estado">
                    <?php
                    /*
                        $estado = $alumno->getEstado();
                        if ($estado === null || $estado === 0 ) {
                            echo 'Solicitud enviada';
                        } else if ($estado === 1) {
                            echo 'Preselección';
                        } else if ($estado === 2) {
                            echo 'Fuera de concurso (Supera permanencia)';
                        } else if ($estado === 3) {
                            echo 'Fuera de concurso (Faltan datos)';
                        } else if ($estado === 4) {
                            echo 'Fuera de concurso (No es usuario registrado)';
                        }
                        */
                    ?>
                    </span>
            </div>
            <!-- para cuando esten los resultados
            <div class="resultado__container">
                <h1 class="resultado__texto">
                    RESULTADO: 
                </h1>
                <h1 class="resultado__texto">
                <?php 
                if ($alumno->getResultado() === 'FUERA DE CONCURSO: MENOS DE 2 MATERIAS APROBADAS EN 2018') {
                    echo 'FUERA DE CONCURSO: MENOS DE 2 MATERIAS APROBADAS EN 2018 SEGÚN UNIDAD ACADÉMICA';
                } else if ($alumno->getResultado() === 'FUERA DE CONCURSO.PROMEDIO INFERIOR A 5' || $alumno->getResultado() === 'FUERA DE CONCURSO: PROMEDIO INFERIOR A 5') {
                    echo 'FUERA DE CONCURSO: PROMEDIO INFERIOR A 5 SEGÚN UNIDAD ACADÉMICA';
                } else if ($alumno->getResultado() === 'BECA APROBADA. A LA BREVEDAD LE COMUNICAREMOS LUGAR Y FECHA DE COBRO.') {
                    echo 'BECA APROBADA';
                } else {
                    echo $alumno->getResultado();
                }
                
                ?></h1>
                <h1 style="text-align: center;">
                <?php
                    if ($alumno->getResultado() === 'BECA APROBADA. A LA BREVEDAD LE COMUNICAREMOS LUGAR Y FECHA DE COBRO.') {
                        echo 'El pago se efectuará en la tesorería de su facultad. Consulte allí mismo la fecha de pago. ';
                    }
                ?>
                </h1>
            </div>
            -->
            <div class="caratula__datos">
                <h3>Datos personales</h3>
                <ul class="caratula__datos__info">
                    <li><b>DNI: </b><?php echo $alumno->getDNI();?></li>
                    <li><b>Email: </b><?php echo $alumno->getEmail();?></li>
                    <li><b>Teléfono: </b><?php echo $alumno->getTelefono();?></li>
                </ul>
                <h3>Datos académicos</h3>
                <ul class="caratula__datos__info">
                    <li><b>Facultad: </b><?php echo $alumno->getFacultad();?></li>
                    <li><b>Carrera: </b><?php echo $alumno->getCarrera();?></li>
                    <li><b>Cantidad de materias de la carrera: </b><?php echo $alumno->getCantidadMaterias();?></li>
                    <li><b>Año de ingreso a la facultad: </b><?php echo $alumno->getAnioIngreso();?></li>
                    <li><b>Promedio: </b><?php echo $alumno->getPromedio();?></li>
                    <li><b>Materias aprobadas el último ciclo lectivo (01/04/2018 al 31/03/2019): </b><?php echo $alumno->getMateriasAprobadas();?></li>
                    <li><b>Cantidad de materias rendidas: </b><?php echo $alumno->getExamenesRendidos();?></li>
                    <li><b>Duración de la carrera: </b><?php echo $alumno->getAniosCarrera();?> años</li>
                </ul>
                <h3>Datos familiares</h3>
                <ul class="caratula__datos__info">
                    <li><b>Ingresos: </b>$<?php echo $alumno->getIngresos();?></li>
                    <li><b>Egresos: </b>$<?php echo $alumno->getEgresos();?></li>
                    <li><b>Integrantes del grupo familiar: </b><?php echo $alumno->getIntegrantesFamilia();?></li>
                </ul>
                <?php
                    if($user->getTipoUsuario() === 0){
                        echo '
                        <h3>Otros datos</h3>
                        <ul class="caratula__datos__info">
                            <li><b>Vulnerabilidad: </b>';
                            if ($alumno->getVulnerabilidad()){
                                echo $alumno->getVulnerabilidad();
                            } else {
                                echo '<span style="color: red; font-weight: 700;">Vunerabilidad no cargada</span>';
                            }
                            echo '</li>
                            <li><b>Distancia: </b>';
                            if ($alumno->getDistancia()){
                                echo $alumno->getDistancia();
                            } else {
                                echo '<span style="color: red; font-weight: 700;">Distancia no cargada</span>';
                            }
                            echo '</li>
                        </ul>
                        ';
                    }
                ?>

                <div>
                    <h4>Creado el <?php echo $alumno->getFechaCreacion() ?> </h4>
                    <?php
                        if ($alumno->getFechaEdicion()) {
                            echo '<h4>Editado el ' .$alumno->getFechaCreacion() .'</h4>';
                        }
                        if ($user->getTipoUsuario() === 0){

                        // ALGORITMO DE CALCULO DE MERITOS

                        //MERITO FAMILIAR
                        $factorCorreccion = ($alumno->getIntegrantesFamilia() - 4) * $salarioMinimo /5;
                        if ($factorCorreccion < 0) {
                            $factorCorreccion = 0;
                        }

                        if (($alumno->getIngresos() - $factorCorreccion) <= $salarioMinimo ) {
                            $meritoFamiliar = 40;
                        } else if (($alumno->getIngresos() - $factorCorreccion) < 3 * $salarioMinimo){
                            $meritoFamiliar = -20 * ($alumno->getIngresos() - $factorCorreccion) / $salarioMinimo + 60;
                        } else {
                            $meritoFamiliar = 0;
                        }

                        // MERITO POR PROMEDIO  

                        if ($alumno->getPromedio() > 5){
                            $meritoPromedio = 4 * $alumno->getPromedio() - 20;                         
                        } else {
                            $meritoPromedio = 0;                        
                        }

                        // MERITO POR REGULARIDAD

                        $materiasPorAnio = $alumno->getCantidadMaterias()/$alumno->getAniosCarrera();
                        if ($alumno->getMateriasAprobadas() <= 2) {
                            $condicionMaterias = 0;
                        } else {
                            $condicionMaterias = ($alumno->getMateriasAprobadas() - 2)/$materiasPorAnio;
                        }

                        if ($condicionMaterias > 1) {
                            $meritoRegularidad = 10;
                        } else {
                            $meritoRegularidad = round(10 * $condicionMaterias, 4);
                        }

                        // SUMA DE MERITOS

                        $merito = $meritoPromedio + $meritoFamiliar + $meritoRegularidad + $alumno->getVulnerabilidad() + $alumno->getDistancia();
                            echo '<h3 class="puntuacion">' .$alumno->getResultado() .'</h3>';
                        }
                    ?>
                </div>
            </div>
            <?php
                if ($user->getTipoUsuario() === 0) {
                    $userSession->setAlumno($alumnoJson);
                    // $userSession->setMerito($merito);
                    echo '
                    <div class="button_flex">
                        <button class="button atras registrarse" onclick="location=`../index.php`">Atras</button>
                        <button class="button atras" onclick="location=`EditarAlumno.php`">Editar</button>
                        <button class="button atras" onclick="location=`AgregarDatos.php`">Agregar datos</button>
                        <button class="button atras" onclick="location=`Estado.php`">Estado</button>

                    </div>
                    ';
                } else if ($alumno->getFechaEdicion() === null) {
                    //echo '<div class="incorrecto">La convocatoria ha cerrado. Ya no se permite la edición de datos.</div>';                    
                    $userSession->setAlumno($alumnoJson);
                    echo '<button class="button atras" onclick="location=`components/EditarAlumno.php`">Editar</button>';                    
                }
            ?>
    </div>
</body>
</html>
