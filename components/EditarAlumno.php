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
    }

    if (isset($_SESSION['alumno'])){
        $alumnoSession = $_SESSION['alumno'];
        $alumnoDecoded = json_decode($alumnoSession, true);
        $id = $alumnoDecoded['idAlumno'];
    } else {
        header("Location: ../index.php");
    }

    $alumno = new Alumno();


    $alumno->setAlumnoByUser($alumnoSession);
?>
<nav class="top-bar">
    Bienvenido/a, <?php echo $user->getNombre(); ?>
    <a class="cerrar-sesion" href=<?php echo $logout; ?>>Cerrar sesión</a>
</nav>
<?php
    if (isset($_POST['aceptar']) || $user->getTipoUsuario() === 0 && !isset($_POST['facultad']) ) {
        echo '
        <form action="" method="POST" class="registro">
            <h2>Editar datos de  ' .$alumnoDecoded['apellido'] .', ' .$alumnoDecoded['nombre'] .'</h2>
            ';
            echo '
            <div class="registro__form">
                <div class="registro__flex">
                    <p>Apellidos: <br>
                    <input type="text" name="apellidos" value="' .$alumnoDecoded['apellido'] .'">
                    </p>
                    <p>Nombres: <br>
                    <input type="text" name="nombres" value="' .$alumnoDecoded['nombre'] .'">
                    </p>
                </div>
                <p>DNI: <br>
                    <input type="number" name="dni" value="' .$alumnoDecoded['dni'] .'">
                </p>
                <p>Email: <br>
                    <input type="email" name="email" value="' .$alumnoDecoded['email'] .'">
                </p>
                <p class="registro__tel">Teléfono: <br>
                    <input type="tel" name="telefono" value="' .$alumnoDecoded['telefono'] .'">
                </p>
                <p>Seleccione su facultad <br>
                    <select name="facultad" value="' .$alumnoDecoded['Facultad'] .'">';
                    foreach ($facultades as &$fac){
                        if ($fac->getNombre() === $alumnoDecoded['Facultad']){
                            echo '<option selected="selected" value="' .$fac->getNombre() .'">' .$fac->getNombre() .'</option>';
                        } else {
                            echo '<option value="' .$fac->getNombre() .'">' .$fac->getNombre() .'</option>';
                        }
                    };
                    echo
                    '</select>
                </p>
                <div class="registro__button">
                    <input type="submit" value="Siguiente" class="button">
                    <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                </div>
            </div>
        </form>
        ';
    } else if (!isset($_POST['aceptarEdicion']) && isset($_POST['ingresos']) && isset($_POST['egresos']) && isset($_POST['integrantes'])){
        $facultad = $_POST['facultad'];
        $apellidos = $_POST['apellidos'];
        $nombres = $_POST['nombres'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $carrera = $_POST['carrera'];
        $ingreso = $_POST['ingreso'];
        $promedio = $_POST['promedio'];
        $aprobadas = $_POST['aprobadas'];
        $totales = $_POST['totales'];
        $rendidos = $_POST['rendidos'];
        $ingresos = $_POST['ingresos'];
        $egresos = $_POST['egresos'];
        $integrantes = $_POST['integrantes'];
        $aniosCarrera = $_POST['aniosCarrera'];

        echo '
            <form action="" method="POST" class="registro">
                <h2>Datos Ingresados</h2>
                ';
                if ($user->getTipoUsuario() === 1) {
                    echo '<span class="precaucion"><b>Por favor, revise los datos con precaución antes de aceptar los cambios. No podrá volver a editarlos en el futuro.</b></span>';
                }
                echo '
                <p><b>Nombre:</b> ' .$nombres .'</p>
                <p><b>Apellido:</b> ' .$apellidos .'</p>
                <p><b>DNI:</b> ' .$dni .'</p>
                <p><b>Email:</b> ' .$email .'</p>
                <p><b>Telefono:</b> ' .$telefono .'</p>
                <p><b>Facultad:</b> ' .$facultad .'</p>
                <p><b>Carrera:</b> ' .$carrera .'</p>
                <p><b>Año de ingreso:</b> ' .$ingreso .'</p>
                <p><b>Promedio:</b> ' .$promedio .'</p>
                <p><b>Materias aprobadas el último ciclo lectivo:</b> ' .$aprobadas .'</p>
                <p><b>Exámenes rendidos:</b> ' .$rendidos .'</p>
                <p><b>Cantidad de materias de la carrera:</b> ' .$totales .'</p>
                <p><b>Duración de la carrera:</b> ' .$aniosCarrera .' años</p>

                <p><b>Ingresos del grupo familiar:</b> ' .$ingresos .'</p>
                <p><b>Egresos del grupo familiar:</b> ' .$egresos .'</p>
                <p><b>Integrantes del grupo familiar:</b> ' .$integrantes .'</p>
                <p style="padding-top: 10px;font-size: 20px; font-weight: 700;">¿Guardar cambios?</p>

                <select name="facultad" style="display:none;">';
                echo '<option value="' .$facultad .'">' .$facultad .'</option>';
                echo
                '</select>

                <select name="aceptarEdicion" style="display:none;">';
                echo '<option value="aceptarEdicion"> aceptarEdicion </option>';
                echo
                '</select>

                <select name="nombres" style="display:none;">';
                echo '<option value="' .$nombres .'">' .$nombres .'</option>';
                echo
                '</select>

                <select name="apellidos" style="display:none;">';
                echo '<option value="' .$apellidos .'">' .$apellidos .'</option>';
                echo
                '</select>

                <select name="dni" style="display:none;">';
                echo '<option value="' .$dni .'">' .$dni .'</option>';
                echo
                '</select>

                <select name="email" style="display:none;">';
                echo '<option value="' .$email .'">' .$email .'</option>';
                echo
                '</select>

                <select name="telefono" style="display:none;">';
                echo '<option value="' .$telefono .'">' .$telefono .'</option>';
                echo
                '</select>

                <select name="carrera" style="display:none;">';
                echo '<option value="' .$carrera .'">' .$carrera .'</option>';
                echo
                '</select>

                <select name="aniosCarrera" style="display:none;">';
                echo '<option value="' .$aniosCarrera .'">' .$aniosCarrera .'</option>';
                echo
                '</select>
                
                <select name="ingreso" style="display:none;">';
                echo '<option value="' .$ingreso .'">' .$ingreso .'</option>';
                echo
                '</select>

                <select name="promedio" style="display:none;">';
                echo '<option value="' .$promedio .'">' .$promedio .'</option>';
                echo
                '</select>

                <select name="aprobadas" style="display:none;">';
                echo '<option value="' .$aprobadas .'">' .$aprobadas .'</option>';
                echo
                '</select>

                <select name="totales" style="display:none;">';
                echo '<option value="' .$totales .'">' .$totales .'</option>';
                echo
                '</select>

                <select name="rendidos" style="display:none;">';
                echo '<option value="' .$rendidos .'">' .$rendidos .'</option>';
                echo
                '</select>

                <select name="ingresos" style="display:none;">';
                echo '<option value="' .$ingresos .'">' .$ingresos .'</option>';
                echo
                '</select>

                <select name="egresos" style="display:none;">';
                echo '<option value="' .$egresos .'">' .$egresos .'</option>';
                echo
                '</select>

                <select name="integrantes" style="display:none;">';
                echo '<option value="' .$integrantes .'">' .$integrantes .'</option>';
                echo
                '</select>

                <div class="registro__button" style="margin-bottom: 20px;">
                <input type="submit" value="Aceptar" class="button">
                <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
            </div>
            </form>
        ';
    } else if (isset($_POST['aceptarEdicion'])) {
        $facultad = $_POST['facultad'];
        $apellidos = $_POST['apellidos'];
        $nombres = $_POST['nombres'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $carrera = $_POST['carrera'];
        $ingreso = $_POST['ingreso'];
        $promedio = $_POST['promedio'];
        $aprobadas = $_POST['aprobadas'];
        $totales = $_POST['totales'];
        $rendidos = $_POST['rendidos'];
        $ingresos = $_POST['ingresos'];
        $egresos = $_POST['egresos'];
        $integrantes = $_POST['integrantes'];
        $aniosCarrera = $_POST['aniosCarrera'];


        $alumno->editarAlumno($id, $facultad, $apellidos, $nombres, $dni, $email, $telefono, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos, $ingresos, $egresos, $integrantes, $aniosCarrera);

        $_SESSION['alumno'] = null;
        header("Location: ../index.php");
    } else if (isset($_POST['facultad']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['email']) && !isset($_POST['carrera'])){
        if ($_POST['nombres'] === '' || $_POST['apellidos'] === '' || $_POST['dni'] === '' || $_POST['email'] === ''){
            echo '
            <div class="incorrecto" style="margin-left: 50px; padding-top: 90px;">
                <form action="" method="POST">
                    ERROR: Para editar sus datos, deberá completar todos los campos. Por favor, intente nuevamente.
                    <br>
                    <select name="aceptar" style="display:none;">
                        <option value="aceptar">true</option>
                    </select>
                    <input type="submit" value="Reintentar" class="button" style="margin-top: 20px;">
                </form>
            </div>';
        } else {
            $facultad = $_POST['facultad'];
            $apellidos = $_POST['apellidos'];
            $nombres = $_POST['nombres'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            foreach ($facultades as &$fac){
                if ($fac->getNombre() === $_POST['facultad']){
                    $carreras = $fac->getCarreras();
                }
            };
            echo '
                <form action="" method="POST" class="registro">
                <h2>Editar datos de  ' .$alumnoDecoded['apellido'] .', ' .$alumnoDecoded['nombre'] .'</h2>
                <div class="registro__form">
                    <select name="facultad" style="display:none;">';
                    echo '<option value="' .$facultad .'">' .$facultad .'</option>';
                    echo
                    '</select>

                    <select name="nombres" style="display:none;">';
                    echo '<option value="' .$nombres .'">' .$nombres .'</option>';
                    echo
                    '</select>

                    <select name="apellidos" style="display:none;">';
                    echo '<option value="' .$apellidos .'">' .$apellidos .'</option>';
                    echo
                    '</select>

                    <select name="dni" style="display:none;">';
                    echo '<option value="' .$dni .'">' .$dni .'</option>';
                    echo
                    '</select>

                    <select name="email" style="display:none;">';
                    echo '<option value="' .$email .'">' .$email .'</option>';
                    echo
                    '</select>

                    <select name="telefono" style="display:none;">';
                    echo '<option value="' .$telefono .'">' .$telefono .'</option>';
                    echo
                    '</select>
                    <p>Carrera <br>
                        <select name="carrera">';
                        foreach ($carreras as &$carr){
                            if ($carr === $alumnoDecoded['Carrera']){
                                echo '<option selected="selected" value="' .$carr .'">' .$carr .'</option>';
                            } else {
                                echo '<option value="' .$carr .'">' .$carr .'</option>';
                            }
                        };
                    echo '</select>
                    </p>
                    <p>Año de ingreso a la facultad: <br>
                        <input type="number" name="ingreso" value="' .$alumnoDecoded['AnioIngreso'] .'">
                    </p>
                    <p>Promedio (Separar decimales con punto. <b>Ejemplo: 8.265</b>): <br>
                        <input type="number" step="0.001" name="promedio" value="' .$alumnoDecoded['Promedio'] .'">
                    </p>
                    <p>Cantidad de materias aprobadas en el último ciclo lectivo <br><b>(Del 01/04/2018 al 31/03/2019)</b>: <br>
                        <input type="number" name="aprobadas" value="' .$alumnoDecoded['MateriasAprobadas'] .'">
                    </p>
                    <p>Cantidad de materias de la carrera: <br>
                        <input type="number" name="totales" value="' .$alumnoDecoded['CantidadMaterias'] .'">
                    </p>
                    <p>Cantidad de examenes rendidos en total: <br>
                        <input type="number" name="rendidos" value="' .$alumnoDecoded['ExamenesRendidos'] .'">
                    </p>
                    <p>Duración de la carrera en años: <br>
                        <input type="number" name="aniosCarrera" value="' .$alumnoDecoded['AniosCarrera'] .'">
                    </p>
                    <div class="registro__button">
                        <input type="submit" value="Siguiente" class="button">
                        <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                    </div>
                </div>
                </form>';
            }
        } else if (isset($_POST['carrera']) && isset($_POST['ingreso']) && isset($_POST['promedio']) && isset($_POST['aprobadas']) && isset($_POST['totales']) && isset($_POST['rendidos'])){
            if ($_POST['carrera'] !== '' && $_POST['ingreso'] !== 0 && $_POST['promedio'] !== 0 && $_POST['aprobadas'] !== '' && $_POST['totales'] !== 0 && $_POST['rendidos'] !== ''){
                if ($_POST['promedio'] > 10 || $_POST['aprobadas'] > $_POST['rendidos'] || $_POST['aprobadas'] > $_POST['totales'] || $_POST['rendidos'] > $_POST['totales'] || $_POST['ingreso'] > 2019) {
                    echo '
                    <div class="incorrecto" style="margin-left: 50px; padding-top: 90px;">
                        <form action="" method="POST">
                            ERROR: Los datos ingresados son inválidos. Por favor intente nuevamente.
                            <br>
                            <select name="aceptar" style="display:none;">
                                <option value="aceptar">true</option>
                            </select>
                            <input type="submit" value="Reintentar" class="button" style="margin-top: 20px;">
                        </form>
                    </div>';
                } else {
                    $facultad = $_POST['facultad'];
                    $apellidos = $_POST['apellidos'];
                    $nombres = $_POST['nombres'];
                    $dni = $_POST['dni'];
                    $email = $_POST['email'];
                    $telefono = $_POST['telefono'];

                    $carrera = $_POST['carrera'];
                    $ingreso = $_POST['ingreso'];
                    $promedio = $_POST['promedio'];
                    $aprobadas = $_POST['aprobadas'];
                    $totales = $_POST['totales'];
                    $rendidos = $_POST['rendidos'];
                    $aniosCarrera = $_POST['aniosCarrera'];

                    echo '
                    <form action="" method="POST" class="registro">
                        <h2>Editar datos de ' .$alumnoDecoded['apellido'] .', ' .$alumnoDecoded['nombre'] .'</h2>
                        <select name="facultad" style="display:none;">';
                        echo '<option value="' .$facultad .'">' .$facultad .'</option>';
                        echo
                        '</select>
    
                        <select name="nombres" style="display:none;">';
                        echo '<option value="' .$nombres .'">' .$nombres .'</option>';
                        echo
                        '</select>
    
                        <select name="apellidos" style="display:none;">';
                        echo '<option value="' .$apellidos .'">' .$apellidos .'</option>';
                        echo
                        '</select>
    
                        <select name="dni" style="display:none;">';
                        echo '<option value="' .$dni .'">' .$dni .'</option>';
                        echo
                        '</select>

                        <select name="aniosCarrera" style="display:none;">';
                        echo '<option value="' .$aniosCarrera .'">' .$aniosCarrera .'</option>';
                        echo
                        '</select>
    
                        <select name="email" style="display:none;">';
                        echo '<option value="' .$email .'">' .$email .'</option>';
                        echo
                        '</select>
    
                        <select name="telefono" style="display:none;">';
                        echo '<option value="' .$telefono .'">' .$telefono .'</option>';
                        echo
                        '</select>

                        <select name="carrera" style="display:none;">';
                        echo '<option value="' .$carrera .'">' .$carrera .'</option>';
                        echo
                        '</select>
    
                        <select name="ingreso" style="display:none;">';
                        echo '<option value="' .$ingreso .'">' .$ingreso .'</option>';
                        echo
                        '</select>
    
                        <select name="promedio" style="display:none;">';
                        echo '<option value="' .$promedio .'">' .$promedio .'</option>';
                        echo
                        '</select>
    
                        <select name="aprobadas" style="display:none;">';
                        echo '<option value="' .$aprobadas .'">' .$aprobadas .'</option>';
                        echo
                        '</select>
    
                        <select name="totales" style="display:none;">';
                        echo '<option value="' .$totales .'">' .$totales .'</option>';
                        echo
                        '</select>
    
                        <select name="rendidos" style="display:none;">';
                        echo '<option value="' .$rendidos .'">' .$rendidos .'</option>';
                        echo
                        '</select>
                        <div class="registro__form familiares">
                        <p>
                        Ingresos totales en pesos (Sumatoria de los ingresos económicos de todos los integrantes del grupo familiar. Escriba el número <b>sin puntos</b>, salvo para indicar centavos): <br>
                            <div class="monto">
                            <span>$</span>
                            <input type="number" step="0.01" name="ingresos" value="' .$alumnoDecoded['Ingresos'] .'">
                            </div>
                        </p>
                        <p>Egresos totales en pesos (Sumatoria de los servicios, impuestos y créditos del grupo familiar. Escriba el número <b>sin puntos</b>, salvo para indicar centavos):  <br>
                            <div class="monto">
                            <span>$</span>
                            <input type="number" step="0.01" name="egresos" value="' .$alumnoDecoded['Egresos'] .'">
                            </div>
                        </p>
                        <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
                            <input type="number" name="integrantes" value="' .$alumnoDecoded['IntegrantesFamilia'] .'">
                        </p>
                        <div class="registro__button">
                            <input type="submit" value="Siguiente" class="button">
                            <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                        </div>
                        </div>
                    </form>
                    ';
                }
            } else {
                echo '
                <div class="incorrecto" style="margin-left: 50px; padding-top: 90px;">
                    <form action="" method="POST">
                        ERROR: Para editar sus datos, deberá completar todos los campos. Por favor, intente nuevamente.
                        <br>
                        <select name="aceptar" style="display:none;">
                            <option value="aceptar">true</option>
                        </select>
                        <input type="submit" value="Reintentar" class="button" style="margin-top: 20px;">
                    </form>
                </div>';
            }
        } else if ($user->getTipoUsuario() === 1){
        echo 
        '
        <div class="solicitud__background">
            <form action="" method="POST">
                <div class="editar__warning">
                    <select name="aceptar" style="display:none;">
                        <option value="aceptar">true</option>
                    </select>
                    <h2 class="warning">ATENCIÓN</h2>
                    <p class="editar__p">Usted podrá editar sus datos <b style="color: red;">sólo una vez</b></p>
                    <p class="editar__p">Una vez editados sus datos, se deshabilitará el botón de edición y su información no podrá ser cambiada en el futuro, por lo que se pide precaución al acceder a esta funcionalidad.</p>
                    <p class="editar__p">¿Desea continuar?</p>
                    <div class="editar__buttons">
                        <input type="submit" value="Continuar" class="button"/>
                        <a class="button registrarse" onclick="location=`../index.php`">Atras</a>
                    </div>
            </div>
        </form>
        ';
    }
?>

