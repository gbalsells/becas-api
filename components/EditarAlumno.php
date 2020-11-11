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
                <p> Lugar donde reside en época de aislamiento/distanciamiento social preventivo obligatorio: </p>
                <div class="domicilio">
                    <p>
                        Domicilio (Calle, Número, Piso, Departamento): <br>
                        <input type="text" name="domicilio" value="' .$alumnoDecoded['Domicilio'] .'">
                    </p>
                    <p>
                        Localidad: <br>
                        <input type="text" name="localidad" value="' .$alumnoDecoded['Localidad'] .'">
                    </p>
                    <p>
                        Provincia: <br>
                        <input type="text" name="provincia" value="' .$alumnoDecoded['Provincia'] .'">
                    </p>
                </div>
                <p>Email: <br>
                    <input type="email" name="email" value="' .$alumnoDecoded['email'] .'">
                </p>
                <p class="registro__tel">Número de celular (Sin 0 ni 15): <br>
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
                <div class="registro__button" style="padding-bottom: 20px;">
                    <input type="submit" value="Siguiente" class="button">';
                    if ($user->getTipoUsuario() === 0) {
                        echo '<a class="button registrarse" style="margin-top: 20px" href="javascript:history.go(-1);">Cancelar</a>';
                    } else {
                        echo '<a class="button registrarse" onclick="location=`../index.php`">Cancelar</a>';
                    }
                echo '
                </div>
            </div>
        </form>
        ';
    } else if (!isset($_POST['aceptarEdicion']) && isset($_POST['ingresos']) && isset($_POST['integrantes'])){
        $facultad = $_POST['facultad'];
        $apellidos = $_POST['apellidos'];
        $nombres = $_POST['nombres'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $carrera = $_POST['carrera'];
        $materias = $_POST['materias'];
        $aniosCarrera = $_POST['aniosCarrera'];
        $integrantes = $_POST['integrantes'];
        $domicilio = $_POST['domicilio'];
        $localidad = $_POST['localidad'];
        $provincia = $_POST['provincia'];


        if ($esBecaConectar === 1) {
            $ingresos = implode(", ",array_unique(array_filter($_POST['ingresos'])));
            $familiaresInternet = $_POST['familiaresInternet'];
            if ($_POST['tieneHijos'] === '1' && $_POST['cantidadHijos'] === '' ||
                $_POST['vulnerabilidad'] === 'Si' && $_POST['descripcionVulnerabilidad'] === '' || $_POST['integrantes'] === '0' || $_POST['integrantes'] === '') {
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
                $telefono4G = $_POST['telefono4G'];
                $telefonoLiberado = $_POST['telefonoLiberado'];
                $compania = $_POST['compania'];
                $mejorCompania = $_POST['mejorCompania'];
                $hijos = 'No';
                if($_POST['tieneHijos'] === '1' ) {
                  $hijos = $_POST['cantidadHijos'];
                }
                $vulnerabilidad = 'No';
                if($_POST['vulnerabilidad'] === 'Si' ) {
                  $vulnerabilidad = $_POST['descripcionVulnerabilidad'];
                } else if ($_POST['vulnerabilidad'] === 'NC' ) {
                  $vulnerabilidad = 'No deseo contestar';
                }
                echo '
                    <form action="" method="POST" class="resumen">
                        <h2>Datos Ingresados</h2>
                        ';
                        if ($user->getTipoUsuario() === 1) {
                            echo '<span class="precaucion"><b>Por favor, revise los datos con precaución antes de aceptar los cambios. No podrá volver a editarlos en el futuro.</b></span>';
                        }
                        echo '
                        <p><b>Nombre:</b> ' .$nombres .'</p>
                        <p><b>Apellido:</b> ' .$apellidos .'</p>
                        <p><b>DNI:</b> ' .$dni .'</p>
                        <p><b>Domicilio:</b> ' .$domicilio .'</p>
                        <p><b>Localidad:</b> ' .$localidad .'</p>
                        <p><b>Provincia:</b> ' .$provincia .'</p>
                        <p><b>Email:</b> ' .$email .'</p>
                        <p><b>Telefono:</b> ' .$telefono .'</p>
                        <p><b>Facultad:</b> ' .$facultad .'</p>
                        <p><b>Carrera:</b> ' .$carrera .'</p>
                        <p><b>Materias que se encuentra cursando:</b> ' .$materias .' </p>
    
                        <p><b>Integrantes del grupo familiar: </b> ' .$integrantes .'</p>
                        <p><b>Integrantes del grupo familiar que usan Internet por cuestiones académicas : </b> ' .$familiaresInternet .'</p>
                        <p><b>Fuente de Ingresos: </b>' .$ingresos .'</p>
                        <p><b>Personas a cargo: </b>' .$hijos .'</p>
                        <p><b>Tiene teléfono 4G: </b>' .$telefono4G .'</p>
                        <p><b>Tiene teléfono Liberado: </b>' .$telefonoLiberado .'</p>
                        <p><b>Compañía que posee: </b>' .$compania .'</p>
                        <p><b>Compañía con mejor cobertura en su zona: </b>' .$mejorCompania .'</p>
                        <p><b>Vulnerabilidad: </b>' .$vulnerabilidad .'</p>
    
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

                        <select name="domicilio" style="display:none;">';
                        echo '<option value="' .$domicilio .'">' .$domicilio .'</option>';
                        echo
                        '</select>

                        <select name="localidad" style="display:none;">';
                        echo '<option value="' .$localidad .'">' .$localidad .'</option>';
                        echo
                        '</select>

                        <select name="provincia" style="display:none;">';
                        echo '<option value="' .$provincia .'">' .$provincia .'</option>';
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
                        
                        <select name="ingresos" style="display:none;">';
                        echo '<option value="' .$ingresos .'">' .$ingresos .'</option>';
                        echo
                        '</select>
        
                        <select name="hijos" style="display:none;">';
                        echo '<option value="' .$hijos .'">' .$hijos .'</option>';
                        echo
                        '</select>
    
                        <select name="telefono4G" style="display:none;">';
                        echo '<option value="' .$telefono4G .'">' .$telefono4G .'</option>';
                        echo
                        '</select>
    
                        <select name="telefonoLiberado" style="display:none;">';
                        echo '<option value="' .$telefonoLiberado .'">' .$telefonoLiberado .'</option>';
                        echo
                        '</select>
    
                        <select name="compania" style="display:none;">';
                        echo '<option value="' .$compania .'">' .$compania .'</option>';
                        echo
                        '</select>
    
                        <select name="mejorCompania" style="display:none;">';
                        echo '<option value="' .$mejorCompania .'">' .$mejorCompania .'</option>';
                        echo
                        '</select>
    
                        <select name="vulnerabilidad" style="display:none;">';
                        echo '<option value="' .$vulnerabilidad .'">' .$vulnerabilidad .'</option>';
                        echo
                        '</select>
        
                        <select name="integrantes" style="display:none;">';
                        echo '<option value="' .$integrantes .'">' .$integrantes .'</option>';
                        echo
                        '</select>

                        <select name="familiaresInternet" style="display:none;">';
                        echo '<option value="' .$familiaresInternet .'">' .$familiaresInternet .'</option>';
                        echo
                        '</select>
        
                        <select name="materias" style="display:none;">';
                        echo '<option value="' .$materias .'">' .$materias .'</option>';
                        echo
                        '</select>
        
                        <div class="registro__button" style="margin-bottom: 20px;">
                        <input type="submit" value="Aceptar" class="button">
                        <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                    </div>
                    </form>
                ';
            }
        } else {
            if ($_POST['tieneHijos'] === '1' && $_POST['FamiliarCargo'] === '' ||
                $_POST['vulnerabilidad'] === 'Si' && $_POST['descripcionVulnerabilidad'] === '' || $_POST['integrantes'] === '0' || $_POST['integrantes'] === '') {
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
                $ingreso = $_POST['ingreso'];
                $ingresos = $_POST['ingresos'];
                $egresos = $_POST['egresos'];
                $vulnerabilidad = 'No';
                if($_POST['vulnerabilidad'] === 'Si' ) {
                  $vulnerabilidad = $_POST['descripcionVulnerabilidad'];
                } else if ($_POST['vulnerabilidad'] === 'NC' ) {
                  $vulnerabilidad = 'No deseo contestar';
                }
                $familiarCargo = 'No';
                if($_POST['tieneHijos'] === '1') {
                  $familiarCargo = $_POST['FamiliarCargo'];
                }
                echo '
                    <form action="" method="POST" class="resumen">
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
                        <p><b>Año de Ingreso:</b> ' .$ingreso .'</p>
                        <p><b>Materias que se encuentra cursando:</b> ' .$materias .' </p>
        
                        <p><b>Ingresos del grupo familiar:</b> ' .$ingresos .'</p>
                        <p><b>Egresos del grupo familiar:</b> ' .$egresos .'</p>
                        <p><b>Integrantes del grupo familiar:</b> ' .$integrantes .'</p>
                        <p><b>Familiares a cargo:</b> ' .$familiarCargo .'</p>
                        <p><b>Vulnerabilidad:</b> ' .$vulnerabilidad .'</p>
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
    
                        <select name="domicilio" style="display:none;">';
                        echo '<option value="' .$domicilio .'">' .$domicilio .'</option>';
                        echo
                        '</select>
    
                        <select name="localidad" style="display:none;">';
                        echo '<option value="' .$localidad .'">' .$localidad .'</option>';
                        echo
                        '</select>
    
                        <select name="provincia" style="display:none;">';
                        echo '<option value="' .$provincia .'">' .$provincia .'</option>';
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
                            
                        <select name="familiaresInternet" style="display:none;">';
                        echo '<option value="' .$familiaresInternet .'">' .$familiaresInternet .'</option>';
                        echo
                        '</select>
        
                        <select name="materias" style="display:none;">';
                        echo '<option value="' .$materias .'">' .$materias .'</option>';
                        echo
                        '</select>
    
                        <select name="ingreso" style="display:none;">';
                        echo '<option value="' .$ingreso .'">' .$ingreso .'</option>';
                        echo
                        '</select>
    
                        <select name="familiarCargo" style="display:none;">';
                        echo '<option value="' .$familiarCargo .'">' .$familiarCargo .'</option>';
                        echo
                        '</select>
    
                        <select name="vulnerabilidad" style="display:none;">';
                        echo '<option value="' .$vulnerabilidad .'">' .$vulnerabilidad .'</option>';
                        echo
                        '</select>
        
                        <div class="registro__button" style="margin-bottom: 20px;">
                            <input type="submit" value="Aceptar" class="button">
                            <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                        </div>
                    </form>
                ';
            }
        }
    } else if (isset($_POST['aceptarEdicion'])) {
        $facultad = $_POST['facultad'];
        $apellidos = $_POST['apellidos'];
        $nombres = $_POST['nombres'];
        $dni = $_POST['dni'];
        $domicilio = $_POST['domicilio'];
        $localidad = $_POST['localidad'];
        $provincia = $_POST['provincia'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $carrera = $_POST['carrera'];
        $aniosCarrera = $_POST['aniosCarrera'];
        $materias = $_POST['materias'];
        $ingresos = $_POST['ingresos'];
        $integrantes = $_POST['integrantes'];
        $familiaresInternet = $_POST['familiaresInternet'];
        $hijos = $_POST['hijos'];
        $vulnerabilidad = $_POST['vulnerabilidad'];

        if($esBecaConectar === 1) {
            $telefono4G = $_POST['telefono4G'];
            $telefonoLiberado = $_POST['telefonoLiberado'];
            $compania = $_POST['compania'];
            $mejorCompania = $_POST['mejorCompania'];
            $alumno->editarAlumnoConectar($id, $facultad, $apellidos, $nombres, $dni, $email, $telefono, $carrera, $ingresos, $integrantes, $aniosCarrera, $materias, $telefono4G, $telefonoLiberado, $compania, $mejorCompania, $hijos, $vulnerabilidad, $domicilio, $localidad, $provincia, $familiaresInternet);
        } else {
            $egresos = $_POST['egresos'];
            $familiarCargo = $_POST['familiarCargo'];
            $anioIngreso = $_POST['ingreso'];
            $alumno->editarAlumnoTeran($id, $facultad, $apellidos, $nombres, $dni, $email, $telefono, $carrera, $ingresos, $egresos, $integrantes, $aniosCarrera, $materias, $vulnerabilidad, $familiarCargo, $anioIngreso);
        }
        $_SESSION['alumno'] = null;
        header("Location: ../index.php");
    } else if (isset($_POST['facultad']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['email']) && !isset($_POST['carrera'])){
        if ($_POST['nombres'] === '' || $_POST['apellidos'] === '' || $_POST['dni'] === '' || $_POST['email'] === '' || $_POST['domicilio'] === '' || $_POST['localidad'] === '' || $_POST['provincia'] === ''){
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
            $domicilio = $_POST['domicilio'];
            $localidad = $_POST['localidad'];
            $provincia = $_POST['provincia'];
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

                    <select name="domicilio" style="display:none;">';
                    echo '<option value="' .$domicilio .'">' .$domicilio .'</option>';
                    echo
                    '</select>

                    <select name="localidad" style="display:none;">';
                    echo '<option value="' .$localidad .'">' .$localidad .'</option>';
                    echo
                    '</select>

                    <select name="provincia" style="display:none;">';
                    echo '<option value="' .$provincia .'">' .$provincia .'</option>';
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
                    <p style="display: none;">Duración de la carrera en años: <br>
                        <input type="number" name="aniosCarrera" value="' .$alumnoDecoded['AniosCarrera'] .'">
                    </p>
                        <p>Año de ingreso a la facultad: <br>
                        <input type="number" name="ingreso" value="' .$alumnoDecoded['AnioIngreso'] .'">
                    </p>
                    <p style="font-weight: bold;">
                        Nombre de las materias que cursa actualmente en modalidad virtual:
                    </p>';
                    $materias = explode(", ", $alumnoDecoded['Materias']);
                    foreach($materias as &$materia) {
                        echo '<p>Materia ' .(array_search($materia, $materias) + 1) .': <br>
                        <input name="materias[]" value="' .$materia .'">
                    </p>';
                    }
                    for ($i = count($materias) + 1; $i <= 6; $i++) {
                        echo '<p>Materia ' .$i .': <br>
                          <input name="materias[]">
                        </p>';
                    };
                    
                echo '
                    <div class="registro__button" style="padding-bottom: 20px;">
                        <input type="submit" value="Siguiente" class="button">
                        <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                    </div>
                </div>
                </form>';
            }
        } else if ((isset($_POST['carrera']) && isset($_POST['materias']) && isset($_POST['aniosCarrera']))) {
            $materiasUppercase=array_map(function($word) { return ucwords(strtolower($word)); }, $_POST['materias']);
            $materias = implode(", ",array_unique(array_filter($materiasUppercase)));
            if ($_POST['carrera'] !== ''){
                if ($materias === ''){
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
                    $domicilio = $_POST['domicilio'];
                    $localidad = $_POST['localidad'];
                    $provincia = $_POST['provincia'];
                    $email = $_POST['email'];
                    $telefono = $_POST['telefono'];
                    
                    $carrera = $_POST['carrera'];
                    $aniosCarrera = $_POST['aniosCarrera'];
                    $ingreso = $_POST['ingreso'];

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

                        <select name="domicilio" style="display:none;">';
                        echo '<option value="' .$domicilio .'">' .$domicilio .'</option>';
                        echo
                        '</select>

                        <select name="localidad" style="display:none;">';
                        echo '<option value="' .$localidad .'">' .$localidad .'</option>';
                        echo
                        '</select>

                        <select name="provincia" style="display:none;">';
                        echo '<option value="' .$provincia .'">' .$provincia .'</option>';
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

                        <select name="materias" style="display:none;">';
                        echo '<option value="' .$materias .'">' .$materias .'</option>';
                        echo
                        '</select>
    
                        <select name="rendidos" style="display:none;">';
                        echo '<option value="' .$rendidos .'">' .$rendidos .'</option>';
                        
                        if ($esBecaConectar === 1) {
                            echo '
                            </select>
                            <div class="registro__form familiares">
                            <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
                                <input type="number" name="integrantes" value="' .$alumnoDecoded['IntegrantesFamilia'] .'">
                            </p>
                            <p>¿Cuántas personas del grupo familiar usan Internet por cuestiones académicas?: <br>
                                <input type="number" name="familiaresInternet" value="' .$alumnoDecoded['FamiliaresInternet'] .'">
                            </p>
                            <p class="radiop">¿Tiene personas a su cargo?
                                <div class="registro__form hijos">
                                    <div>
                                        <input type="radio" name="tieneHijos" value="1"';
                                        if ($alumnoDecoded['CantidadHijos'] !== 'No') {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="1">Si</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="tieneHijos" value="0"';
                                        if ($alumnoDecoded['CantidadHijos'] === 'No') {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="0">No</label><br>
                                    </div>
                                </div>
                            </p>
                            <p>En caso afirmativo, ¿A quién tiene a cargo? <br>
                                <input name="cantidadHijos" value="' .$alumnoDecoded['CantidadHijos'] .'">
                            </p>
                            <p>Los ingresos de su grupo familiar provienen: <br>
                            <div class="ingresos">';
                            $ingresos = explode(", ", $alumnoDecoded['Ingresos']);
                            if (is_int(array_search('Mercado informal de trabajo', $ingresos))) {
                                echo '
                                <input type="checkbox" checked name="ingresos[]" style="font-weight: lighter;" value="Mercado informal de trabajo">Del mercado informal de trabajo</option> <br>
                                ';
                            } else {
                                echo '
                                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Mercado informal de trabajo">Del mercado informal de trabajo</option> <br>
                                ';
                            }
                            if (is_int(array_search('Planes Sociales', $ingresos))) {
                                echo '
                                <input type="checkbox" checked name="ingresos[]" style="font-weight: lighter;" value="Planes Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</option> <br>
                                ';
                            } else {
                                echo '
                                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Planes Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</option> <br>
                                ';
                            }
                            if (is_int(array_search('Monotributo', $ingresos))) {
                                echo '
                                <input type="checkbox" checked name="ingresos[]" style="font-weight: lighter;" value="Monotributo">De las categorías de Monotributo A y B</option> <br>
                                ';
                            } else {
                                echo '
                                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Monotributo">De las categorías de Monotributo A y B</option> <br>
                                ';
                            }
                            if (is_int(array_search('Actividades frenadas por pandemia', $ingresos))) {
                                echo '
                                <input type="checkbox" checked name="ingresos[]" style="font-weight: lighter;" value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</option> <br>
                                ';
                            } else {
                                echo '
                                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</option> <br>
                                ';
                            }
                            if (is_int(array_search('Otros', $ingresos))) {
                                echo '
                                <input type="checkbox" checked name="ingresos[]" style="font-weight: lighter;" value="Otros">Otros</option>
                                ';
                            } else {
                                echo '
                                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Otros">Otros</option>
                                ';
                            }
                            echo '
                                </select>
                                </p>
                                <p class="radiop">¿Tiene teléfono 4G?
                                <div class="registro__form hijos">
                                    <div>
                                        <input type="radio" name="telefono4G" value="Si"';
                                        if ($alumnoDecoded['Telefono4G'] === "Si") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="Si">Si</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="telefono4G" value="No"';
                                        if ($alumnoDecoded['Telefono4G'] === "No") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="No">No</label><br>
                                    </div>
                                </div>
                                </p>
                                <p class="radiop">¿Su teléfono celular es liberado?
                                    <div class="registro__form hijos">
                                    <div>
                                        <input type="radio" name="telefonoLiberado" value="Si"';
                                        if ($alumnoDecoded['TelefonoLiberado'] === "Si") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="Si">Si</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="telefonoLiberado" value="No"';
                                        if ($alumnoDecoded['TelefonoLiberado'] === "No") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="No">No</label><br>
                                    </div>
                                    </div>
                                </p>
                                <p>Compañía que posee actualmente: <br>
                                    <select name="compania" value="' .$alumnoDecoded['Compania'] .'">';
                                    if ($alumnoDecoded['Compania'] === 'Personal') {
                                        echo '
                                        <option selected="selected" value="Personal">Personal</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Personal">Personal</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['Compania'] === 'Movistar') {
                                        echo '
                                        <option selected="selected" value="Movistar">Movistar</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Movistar">Movistar</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['Compania'] === 'Claro') {
                                        echo '
                                        <option selected="selected" value="Claro">Claro</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Claro">Claro</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['Compania'] === 'Tuenti') {
                                        echo '
                                        <option selected="selected" value="Tuenti">Tuenti</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Tuenti">Tuenti</option>
                                        ';
                                    }
                                    echo '
                                    </select>
                                </p>
                                <p>¿Qué compañía es la que mejor cobertura tiene en la zona donde resides actualmente? <br>
                                    <select name="mejorCompania" value="' .$alumnoDecoded['MejorCompania'] .'">';
                                    if ($alumnoDecoded['MejorCompania'] === 'Personal') {
                                        echo '
                                        <option selected="selected" value="Personal">Personal</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Personal">Personal</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['MejorCompania'] === 'Movistar') {
                                        echo '
                                        <option selected="selected" value="Movistar">Movistar</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Movistar">Movistar</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['MejorCompania'] === 'Claro') {
                                        echo '
                                        <option selected="selected" value="Claro">Claro</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Claro">Claro</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['MejorCompania'] === 'Tuenti') {
                                        echo '
                                        <option selected="selected" value="Tuenti">Tuenti</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="Tuenti">Tuenti</option>
                                        ';
                                    }
                                    if ($alumnoDecoded['MejorCompania'] === 'No se') {
                                        echo '
                                        <option selected="selected" value="No se">No sé</option>
                                        ';
                                    } else {
                                        echo '
                                        <option value="No se">No sé</option>
                                        ';
                                    }
                                    echo '
                                    </select>
                                </p>
                                <p class="radiop">¿Presentas indicadores de vulnerabilidad?
                                <div class="registro__form vulnerabilidad">
                                    <div>
                                        <input type="radio" name="vulnerabilidad" value="Si"';
                                        if ($alumnoDecoded['Vulnerabilidad'] !== "No" && $alumnoDecoded['Vulnerabilidad'] !== "No deseo contestar") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="Si">Si</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="vulnerabilidad" value="No"';
                                        if ($alumnoDecoded['Vulnerabilidad'] === "No") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="No">No</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="vulnerabilidad" value="NC"';
                                        if ($alumnoDecoded['Vulnerabilidad'] === "No deseo contestar") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="NC">No deseo contestar</label><br>
                                    </div>
                                </div>
                                </p>
                                <p>En caso de responder afirmativamente la pregunta anterior, describa brevemente el mismo: <br>
                                <input type="text" name="descripcionVulnerabilidad" value="';
                                if ($alumnoDecoded['Vulnerabilidad'] !== "No" && $alumnoDecoded['Vulnerabilidad'] !== "No deseo contestar") {
                                    echo $alumnoDecoded['Vulnerabilidad'];
                                }
                                echo '">
                                </p>
                                <select name="primerPaso" style="display:none;">
                                <option value="1">PrimerPaso</option>
                                </select>
                                <div class="registro__button">
                                <input type="submit" value="Siguiente" class="button">
                                <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                                </div>
                            </div>
                            </form>';
                        } else {
                            echo
                            '</select>

                            <select name="ingreso" style="display:none;">';
                            echo '<option value="' .$ingreso .'">' .$ingreso .'</option>
                            </select>

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
                            <p class="radiop">¿Tiene personas a su cargo?
                                <div class="registro__form hijos">
                                    <div>
                                        <input type="radio" name="tieneHijos" value="1"';
                                        if ($alumnoDecoded['FamiliarCargo'] !== 'No') {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="1">Si</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="tieneHijos" value="0"';
                                        if ($alumnoDecoded['FamiliarCargo'] === 'No') {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="0">No</label><br>
                                    </div>
                                </div>
                            </p>
                            <p>En caso afirmativo, ¿A quién tiene a cargo? <br>
                                <input name="FamiliarCargo" value="' .$alumnoDecoded['FamiliarCargo'] .'">
                            </p>';
                            echo '
                            <p class="radiop">¿Presentas indicadores de vulnerabilidad?
                                <div class="registro__form vulnerabilidad">
                                    <div>
                                        <input type="radio" name="vulnerabilidad" value="Si"';
                                        if ($alumnoDecoded['Vulnerabilidad'] !== "No" && $alumnoDecoded['Vulnerabilidad'] !== "No deseo contestar") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="Si">Si</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="vulnerabilidad" value="No"';
                                        if ($alumnoDecoded['Vulnerabilidad'] === "No") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="No">No</label><br>
                                    </div>
                                    <div>
                                        <input type="radio" name="vulnerabilidad" value="NC"';
                                        if ($alumnoDecoded['Vulnerabilidad'] === "No deseo contestar") {
                                            echo 'checked';
                                        }
                                        echo '>
                                        <label for="NC">No deseo contestar</label><br>
                                    </div>
                                </div>
                                </p>
                                <p>En caso de responder afirmativamente la pregunta anterior, describa brevemente el mismo: <br>
                                <input type="text" name="descripcionVulnerabilidad" value="';
                                if ($alumnoDecoded['Vulnerabilidad'] !== "No" && $alumnoDecoded['Vulnerabilidad'] !== "No deseo contestar") {
                                    echo $alumnoDecoded['Vulnerabilidad'];
                                }
                                echo '">
                                </p>
                            <div class="registro__button" style="padding-bottom: 20px;">
                                <input type="submit" value="Siguiente" class="button">
                                <a class="button registrarse" style="margin-left:10px;" onclick="location=`../index.php`">Cancelar</a>
                            </div>
                            </div>
                        </form>
                        ';
                        }
                        
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

