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
        
        $alumno = new Alumno();
        $id = $_REQUEST['id'];
        $logout = "../models/logout.php";
        
        $userSession = new UserSession();
        $user = new User();

        $hayBeca = $alumno->esBecaConectar($id);
        $esBecaConectar = $hayBeca["esBecaConectar"];

        if (isset($_SESSION['user'])){
            $user->setUser($userSession->getCurrentUser($user));
        }
    } else {
        $alumno = new Alumno();
        $id = $user->getIdUsuario();
        $logout = "models/logout.php";
        $esBecaConectar = $user->getBeca();
    }

    if ($esBecaConectar) {
        $alumno->setAlumnoByUserConectar($id);
        $beca = 'Conectividad';
    } else {
        $alumno->setAlumnoByUserTeran($id);
        $beca = 'Juan B. Teran';
    }
    $alumnoJson = json_encode($alumno);

    if ($user->getTipoUsuario() !== 0) {
        $userSession->setAlumno($alumnoJson);
        $id = $alumno->getId();
        $tieneDoc = $alumno->tieneDocumentacion($id);
        if (!$tieneDoc) {
            header("Location: components/AdjuntarArchivos.php");
        }
    }
    ?>
    <nav class="top-bar">
        Bienvenido/a, <?php echo $user->getNombre(); ?>
        <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
    </nav>
    <div class="caratula">
        <div class="caratula__contenido">
            <div class="caratula__header">
                <span class="caratula__header__nombre"><?php echo $alumno->getApellido() .', ' .$alumno->getNombre() .' - Beca ' .$beca; ?></span>
                <span class="caratula__header__estado">
                    <?php
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
                // if ($alumno->getResultado() === 'FUERA DE CONCURSO: MENOS DE 2 MATERIAS APROBADAS EN 2018') {
                //     echo 'FUERA DE CONCURSO: MENOS DE 2 MATERIAS APROBADAS EN 2018 SEGÚN UNIDAD ACADÉMICA';
                // } else if ($alumno->getResultado() === 'FUERA DE CONCURSO.PROMEDIO INFERIOR A 5' || $alumno->getResultado() === 'FUERA DE CONCURSO: PROMEDIO INFERIOR A 5') {
                //     echo 'FUERA DE CONCURSO: PROMEDIO INFERIOR A 5 SEGÚN UNIDAD ACADÉMICA';
                // } else if ($alumno->getResultado() === 'BECA APROBADA. A LA BREVEDAD LE COMUNICAREMOS LUGAR Y FECHA DE COBRO.') {
                //     echo 'BECA APROBADA';
                // } else {
                //     echo $alumno->getResultado();
                // }
                
                ?></h1>
                <h1 style="text-align: center;">
                <?php
                    // if ($alumno->getResultado() === 'BECA APROBADA. A LA BREVEDAD LE COMUNICAREMOS LUGAR Y FECHA DE COBRO.') {
                    //     echo 'El pago se efectuará en la tesorería de su facultad. Consulte allí mismo la fecha de pago. ';
                    // }
                ?>
                </h1>
            </div>
            -->
            <div class="caratula__container">
                <div class="caratula__datos">
                    <h3>Datos personales</h3>
                    <ul class="caratula__datos__info">
                        <li><b>DNI: </b><?php echo $alumno->getDNI();?></li>
                        <li><b>Email: </b><?php echo $alumno->getEmail();?></li>
                        <li><b>Teléfono: </b><?php echo $alumno->getTelefono();?></li>
                        <li><b>Domicilio: </b><?php echo $alumno->getDomicilio();?></li>
                        <li><b>Localidad: </b><?php echo $alumno->getLocalidad();?></li>
                        <li><b>Provincia: </b><?php echo $alumno->getProvincia();?></li>
                    </ul>
                    <h3>Datos académicos</h3>
                    <ul class="caratula__datos__info">
                        <li><b>Facultad: </b><?php echo $alumno->getFacultad();?></li>
                        <li><b>Carrera: </b><?php echo $alumno->getCarrera();?></li>
                        <li><b>Materias cursando actualmente: </b>
                            <ul>
                                <?php
                                    $materias = explode(", ", $alumno->getMaterias());
                                    foreach ($materias as &$mat){
                                        echo '<li>' .$mat .'</li>';
                                    };
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <h3>Otros datos</h3>
                        <ul class="caratula__datos__info">
                    <?php
                        if ($esBecaConectar) {
                            echo '
                            <li><b>Integrantes del grupo familiar: </b> ' .$alumno->getIntegrantesFamilia() .'</li>
                            <li><b>Integrantes del grupo familiar que usan Internet por cuestiones académicas: </b>' .$alumno->getFamiliaresInternet() .'</li>
                            <li><b>Fuente de Ingresos: </b>' .$alumno->getIngresos() .'</li>
                            <li><b>Hijos: </b>' .$alumno->getCantidadHijos() .'</li>
                            <li><b>Tiene teléfono 4G: </b>' .$alumno->getTelefono4G() .'</li>
                            <li><b>Tiene teléfono Liberado: </b>' .$alumno->getTelefonoLiberado() .'</li>
                            <li><b>Compañía que posee: </b>' .$alumno->getCompania() .'</li>
                            <li><b>Compañía con mejor cobertura en su zona: </b>' .$alumno->getMejorCompania() .'</li>
                            <li><b>Vunerabilidad: </b>' .$alumno->getVulnerabilidad() .'</li>
                            ';
                        } else {
                            echo '
                            <li><b>Ingresos: </b>' .$alumno->getIngresos() .'</li>
                            <li><b>Egresos: </b>' .$alumno->getEgresos() .'</li>
                            <li><b>Integrantes del grupo familiar: </b> ' .$alumno->getIntegrantesFamilia() .'</li>
                            ';
                        }
                    ?>
                    </ul>
                    <?php
                        // if($user->getTipoUsuario() === 0 && !$esBecaConectar){
                        //     echo '
                        //     <h3>Otros datos</h3>
                        //     <ul class="caratula__datos__info">
                        //         <li><b>Vulnerabilidad: </b>';
                        //         if ($alumno->getVulnerabilidad()){
                        //             echo $alumno->getVulnerabilidad();
                        //         } else {
                        //             echo '<span style="color: red; font-weight: 700;">Vunerabilidad no cargada</span>';
                        //         }
                        //         echo '</li>
                        //         <li><b>Distancia: </b>';
                        //         if ($alumno->getDistancia()){
                        //             echo $alumno->getDistancia();
                        //         } else {
                        //             echo '<span style="color: red; font-weight: 700;">Distancia no cargada</span>';
                        //         }
                        //         echo '</li>
                        //     </ul>
                        //     ';
                        // }
                    ?>
                    <div class="fechasCaratula">
                        <h4>Creado el <?php echo $alumno->getFechaCreacion() ?> </h4>
                        <?php
                            if ($alumno->getFechaEdicion()) {
                                echo '<h4>Editado el ' .$alumno->getFechaEdicion() .'</h4>';
                            }
                            if ($user->getTipoUsuario() === 0){
                                
                                // ALGORITMO DE CALCULO DE MERITOS
                                
                                //MERITO FAMILIAR
                                // $factorCorreccion = ($alumno->getIntegrantesFamilia() - 4) * $salarioMinimo /5;
                                // if ($factorCorreccion < 0) {
                                //     $factorCorreccion = 0;
                                // }
                                
                                // if (($alumno->getIngresos() - $factorCorreccion) <= $salarioMinimo ) {
                                //     $meritoFamiliar = 40;
                                // } else if (($alumno->getIngresos() - $factorCorreccion) < 3 * $salarioMinimo){
                                //     $meritoFamiliar = -20 * ($alumno->getIngresos() - $factorCorreccion) / $salarioMinimo + 60;
                                // } else {
                                //     $meritoFamiliar = 0;
                                // }
                                
                                // // MERITO POR PROMEDIO  
                                
                                // if ($alumno->getPromedio() > 5){
                                //     $meritoPromedio = 4 * $alumno->getPromedio() - 20;                         
                                // } else {
                                //     $meritoPromedio = 0;                        
                                // }
                                
                                // MERITO POR REGULARIDAD
                                
                                // $materiasPorAnio = $alumno->getCantidadMaterias()/$alumno->getAniosCarrera();
                                // if ($alumno->getMateriasAprobadas() <= 2) {
                                //     $condicionMaterias = 0;
                                // } else {
                                //     $condicionMaterias = ($alumno->getMateriasAprobadas() - 2)/$materiasPorAnio;
                                // }
                                
                                // if ($condicionMaterias > 1) {
                                //     $meritoRegularidad = 10;
                                // } else {
                                //     $meritoRegularidad = round(10 * $condicionMaterias, 4);
                                // }
                                
                                // SUMA DE MERITOS
                                
                                // $merito = $meritoPromedio + $meritoFamiliar + $meritoRegularidad + $alumno->getVulnerabilidad() + $alumno->getDistancia();
                                // echo '<h3 class="puntuacion">Puntuacion: ' .$merito .'</h3>';
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
                        <button class="button atras" onclick="location=`EditarAlumno.php`">Editar</button>
                        <button class="button atras" onclick="location=`Estado.php`">Estado</button>';
                    $id = $alumno->getId();
                    $tieneDoc = $alumno->tieneDocumentacion($id);
                    if ($tieneDoc) {
                        echo '<button class="button atras" onclick="location=`Documentacion.php`">Ver Documentación Adjuntada</button>';
                    } else {
                        echo '<button class="button atras" onclick="location=`AdjuntarArchivos.php`">Adjuntar Documentación</button>';
                    }
                    echo '<button class="button atras registrarse" onclick="location=`../index.php`">Atras</button></div>
                    ';
                } else {
                    echo '
                    <div class="button_flex">
                    ';
                    if ($alumno->getFechaEdicion() === null) {
                        $userSession->setAlumno($alumnoJson);
                        echo '<button class="button atras" onclick="location=`components/EditarAlumno.php`">Editar</button>';                    
                    }
                    $userSession->setAlumno($alumnoJson);
                    $id = $alumno->getId();
                    $tieneDoc = $alumno->tieneDocumentacion($id);
                    if ($tieneDoc) {
                        echo '<button class="button atras" onclick="location=`components/Documentacion.php`">Ver Documentación Adjuntada</button>';
                    } else {
                        echo '<button class="button atras" onclick="location=`components/AdjuntarArchivos.php`">Adjuntar Documentación</button>';
                    }
                }
            ?>
            </div>
    </div>
    <?php
        // echo '<div class="incorrecto">La convocatoria ha cerrado. Ya no se permite la edición de datos.</div>';
    ?>                  
</body>
</html>
