<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas UNT</title>
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
    if (isset($_REQUEST['beca'])) {
        if($_REQUEST['beca'] === '0') {
            $alumno->setAlumnoByUserTeran($id);
            $beca = 'Juan B. Teran';
        } else {
            $alumno->setAlumnoByUserConectar($id);
            $beca = 'Conectividad';
        }
    } else {
        if ($esBecaConectar === 1) {
            $alumno->setAlumnoByUserConectar($id);
            $beca = 'Conectividad';
        } else {
            $alumno->setAlumnoByUserTeran($id);
            $beca = 'Juan B. Teran';
        }
    }
    $alumnoJson = json_encode($alumno);

    if ($user->getTipoUsuario() !== 0) {
        $userSession->setAlumno($alumnoJson);
        $id = $alumno->getId();
        $tieneDoc = $alumno->tieneDocumentacion($id);
        if (!$tieneDoc && $esBecaConectar !== 1) {
            // header("Location: components/AdjuntarArchivos.php");
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
            <?php
            $resultados = true; //DESHABILITAR AL ABRIR CONVOCATORIAS
            if ($resultados && $esBecaConectar === 1) {
                $resultadoConectividad = $user->resultadoConectividad($alumno->getDNI());
                if ($resultadoConectividad) {
                    foreach($resultadoConectividad as $alla) {
                        if ($alla['Numero'] === 'NO') {
                            echo '
                            <div class="resultado__container">
                                <h2>BECA CONECTIVIDAD OTORGADA</h2>
                                <p style="max-width: 700px;"><b>FELICIDADES!</b> Sos beneficiario de la Beca de Conectividad, la cual consiste en una recarga de 6 GB de datos de la empresa que posees actualmente, ya que declaraste en la ficha inscripción que no resides actualmente en la provincia de Tucumán. <br><br>La recarga se realizará mensualmente mientras dure la actividad académica remota. Las fechas previstas de recarga son: </p>
                                <ul>
                                    <li>11/12/20</li>
                                    <li>01/03/21</li>
                                    <li>01/04/21</li>
                                    <li>01/05/21</li>
                                </ul>
                            </div>
                        ';
                        } else {
                            echo '
                                <div class="resultado__container">
                                <h2>BECA CONECTIVIDAD OTORGADA</h2>
                                    <p style="max-width: 700px;"><b>FELICIDADES!</b> Sos beneficiario/a de la Beca de Conectividad, la cual consiste en un chip prepago de la Empresa <b>' .$alla['Empresa'] .'</b> con 6GB de datos. La recarga se realizará mensualmente, mientras dure la actividad académica remota. Las fechas previstas de recarga son: </p>
                                    <ul>
                                        <li>11/12/20</li>
                                        <li>01/03/21</li>
                                        <li>01/04/21</li>
                                        <li>01/05/21</li>
                                    </ul>
                                    <p>El Centro de Estudiantes de tu facultad te entregará el Chip prepago.</p>
                                </div>
                            ';
                        }
                    break;
                    }
                } else {
                    echo '
                    <div class="resultado__container">
                        <h2>BECA CONECTIVIDAD NO OTORGADA</h2>
                        <p>Lamentablemente no cumples con los requisitos para ser beneficiario de la Beca de Conectividad.</p>
                    </div>
                ';
                }
            } else if($resultados && $esBecaConectar === 0) {
                $resultadoTeran = $user->resultadoTeran($alumno->getDNI());
                if ($resultadoTeran) {
                    echo '
                        <div class="resultado__container">
                            <h2>BECA JUAN B. TERÁN OTORGADA</h2>
                            <p style="max-width: 700px;"><b>FELICIDADES!</b> Sos beneficiario de la <b>Beca Juan B. Terán</b>. <br><br> En breve nos comunicaremos vía mail para informarte sobre la forma de pago.</p>
                        </div>
                    ';
                } else {
                    echo '
                    <div class="resultado__container">
                        <h2>BECA JUAN B. TERÁN NO OTORGADA</h2>
                        <p>Lamentablemente no cumples con los requisitos para ser beneficiario de la Beca Juan B. Terán.</p>
                    </div>
                ';
                }
            }
            if($esBecaConectar === 2) {
                $resultadoTeran = $user->resultadoTeran($alumno->getDNI());
                $resultadoConectividad = $user->resultadoConectividad($alumno->getDNI());
                if(!$resultadoTeran && !$resultadoConectividad ) {
                    echo '
                        <div class="resultado__container">
                            <h2>BECAS NO OTORGADAS</h2>
                            <p>Lamentablemente no cumples con los requisitos para ser beneficiario de la Beca Juan B. Terán o la Beca Conectividad</p>
                        </div>
                    ';                
                } else if($beca === 'Juan B. Teran' && !$resultadoTeran && $resultadoConectividad ) {
                    header("Location: index.php?beca=1");
                } else if($beca === 'Conectividad' && !$resultadoConectividad  && $resultadoTeran) {
                    header("Location: index.php?beca=0");
                } else {
                    if ($beca === 'Conectividad') {
                        if ($resultadoConectividad) {
                            foreach($resultadoConectividad as $alla) {
                                if ($alla['Numero'] === 'NO') {
                                    echo '
                                    <div class="resultado__container">
                                        <h2>BECA CONECTIVIDAD OTORGADA</h2>
                                        <p style="max-width: 700px;"><b>FELICIDADES!</b> Sos beneficiario de la Beca de Conectividad, la cual consiste en una recarga de 6 GB de datos de la empresa que posees actualmente, ya que declaraste en la ficha inscripción que no resides actualmente en la provincia de Tucumán. <br><br>La recarga se realizará mensualmente mientras dure la actividad académica remota. Las fechas previstas de recarga son: </p>
                                        <ul>
                                            <li>11/12/20</li>
                                            <li>01/03/21</li>
                                            <li>01/04/21</li>
                                            <li>01/05/21</li>
                                        </ul>
                                ';
                                } else {
                                    echo '
                                        <div class="resultado__container">
                                        <h2>BECA CONECTIVIDAD OTORGADA</h2>
                                            <p style="max-width: 700px;"><b>FELICIDADES!</b> Sos beneficiario/a de la Beca de Conectividad, la cual consiste en un chip prepago de la Empresa <b>' .$alla['Empresa'] .'</b> con 6GB de datos. La recarga se realizará mensualmente, mientras dure la actividad académica remota. Las fechas previstas de recarga son: </p>
                                            <ul>
                                                <li>11/12/20</li>
                                                <li>01/03/21</li>
                                                <li>01/04/21</li>
                                                <li>01/05/21</li>
                                            </ul>
                                            <p>El Centro de Estudiantes de tu facultad te entregará el Chip prepago.</p>
                                            ';
                                        }
                                        echo '<p>Al haber obtenido la Beca de Conectividad, ya no calificas para la Beca Juan B. Terán.</p>
                                    </div>';
                                    break;
                            }
                        } else {
                            echo '
                            <div class="resultado__container">
                                <h2>BECA CONECTIVIDAD NO OTORGADA</h2>
                                <p>Lamentablemente no cumples con los requisitos para ser beneficiario de la Beca de Conectividad.</p>
                            </div>
                        ';
                        }
                    } else {
                        if ($resultadoTeran) {
                            echo '
                                <div class="resultado__container">
                                    <h2>BECA JUAN B. TERÁN OTORGADA</h2>
                                    <p style="max-width: 700px;"><b>FELICIDADES!</b> Sos beneficiario de la <b>Beca Juan B. Terán</b>. <br><br> En breve nos comunicaremos vía mail para informarte sobre la forma de pago.</p>
                                    <p>Al haber obtenido la Beca de Juan B. Terán, ya no calificas para la Beca Conectividad.</p>
                                </div>
                            ';
                        } else {
                            echo '
                            <div class="resultado__container">
                                <h2>BECA JUAN B. TERÁN NO OTORGADA</h2>
                                <p>Lamentablemente no cumples con los requisitos para ser beneficiario de la Beca Juan B. Terán.</p>
                            </div>
                        ';
                        }
                    }
                }
                // if (isset($_REQUEST['beca']) && $_REQUEST['beca'] === '1') {
                //     echo '<button class="button atras" onclick="location=`index.php?beca=0`">Ver datos Beca Juan B. Terán</button>';
                // } else {
                //     echo '<button class="button atras" onclick="location=`index.php?beca=1`">Ver datos Beca Conectividad</button>';
                // }
            }
            if(!$resultados){
            echo '
            <div class="caratula__container">
                <div class="caratula__datos">
                    <h3>Datos personales</h3>
                    <ul class="caratula__datos__info">
                        <li><b>DNI: </b>' .$alumno->getDNI() .'</li>
                        <li><b>Email: </b>' .$alumno->getEmail() .'</li>
                        <li><b>Teléfono: </b>' .$alumno->getTelefono() .'</li>
                        <li><b>Domicilio: </b>' .$alumno->getDomicilio() .'</li>
                        <li><b>Localidad: </b>' .$alumno->getLocalidad() .'</li>
                        <li><b>Provincia: </b>' .$alumno->getProvincia() .'</li>
                    </ul>
                    <h3>Datos académicos</h3>
                    <ul class="caratula__datos__info">
                        <li><b>Facultad: </b>' .$alumno->getFacultad() .'</li>
                        <li><b>Carrera: </b>' .$alumno->getCarrera() .'</li>';
                        if ($beca === 'Juan B. Teran') {
                            echo '
                            <li><b>Año de Ingreso: </b>' .$alumno->getAnioIngreso() .'</li>
                            ';
                        }
                        echo '
                        <li><b>Materias cursando actualmente: </b>
                            <ul>';
                                    $materias = explode(", ", $alumno->getMaterias());
                                    foreach ($materias as &$mat){
                                        echo '<li>' .$mat .'</li>';
                                    };
                            echo '</ul>
                        </li>
                    </ul>
                    <h3>Otros datos</h3>
                        <ul class="caratula__datos__info">'; 
                        if ($beca === 'Conectividad') {
                            echo '
                            <li><b>Integrantes del grupo familiar: </b> ' .$alumno->getIntegrantesFamilia() .'</li>
                            <li><b>Integrantes del grupo familiar que usan Internet por cuestiones académicas: </b>' .$alumno->getFamiliaresInternet() .'</li>
                            <li><b>Fuente de Ingresos: </b>' .$alumno->getIngresos() .'</li>
                            <li><b>Hijos: </b>' .$alumno->getCantidadHijos() .'</li>
                            <li><b>Tiene teléfono 4G: </b>' .$alumno->getTelefono4G() .'</li>
                            <li><b>Tiene teléfono Liberado: </b>' .$alumno->getTelefonoLiberado() .'</li>
                            <li><b>Compañía que posee: </b>' .$alumno->getCompania() .'</li>
                            <li><b>Compañía con mejor cobertura en su zona: </b>' .$alumno->getMejorCompania() .'</li>
                            <li><b>Vulnerabilidad: </b>' .$alumno->getVulnerabilidad() .'</li>
                            ';
                        } else {
                            echo '
                            <li><b>Integrantes del grupo familiar: </b> ' .$alumno->getIntegrantesFamilia() .'</li>
                            <li><b>Ingresos: </b> $' .$alumno->getIngresos() .'</li>
                            <li><b>Egresos: </b> $' .$alumno->getEgresos() .'</li>
                            <li><b>Familiares a cargo: </b>' .$alumno->getFamiliarCargo() .'</li>
                            <li><b>Vulnerabilidad: </b>' .$alumno->getVulnerabilidad() .'</li>
                            ';
                        }
                    echo '</ul>
                    <div class="fechasCaratula">
                        <h4>Creado el ' .$alumno->getFechaCreacion() .'</h4>';
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
                    echo '</div>
                </div>';
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
                    // if ($alumno->getFechaEdicion() === null && $beca !== 'Conectividad') {
                    //     $userSession->setAlumno($alumnoJson);
                    //     echo '<button class="button atras" onclick="location=`components/EditarAlumno.php`">Editar</button>';                    
                    // }
                    $userSession->setAlumno($alumnoJson);
                    $id = $alumno->getId();
                    $tieneDoc = $alumno->tieneDocumentacion($id);
                    if ($tieneDoc) {
                        echo '<button class="button atras" onclick="location=`components/Documentacion.php`">Ver Documentación Adjuntada</button>';
                    } else {
                        // if ($esBecaConectar!==1) {
                        //     echo '<button class="button atras" onclick="location=`components/AdjuntarArchivos.php`">Adjuntar Documentación</button>';
                        // }
                    }
                    if($esBecaConectar === 1) {
                        // echo '<button class="button atras" onclick="location=`components/SolicitarTeran.php`">Solicitar Beca Juan B. Terán</button>';
                    }
                    if($esBecaConectar === 2) {
                        if (isset($_REQUEST['beca']) && $_REQUEST['beca'] === '1') {
                            echo '<button class="button atras" onclick="location=`index.php?beca=0`">Ver datos Beca Juan B. Terán</button>';
                        } else {
                            echo '<button class="button atras" onclick="location=`index.php?beca=1`">Ver datos Beca Conectividad</button>';
                        }

                    }
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
