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

if (isset($_REQUEST['id'])) {
    include_once '../models/facultad.php';
    include_once '../constants/facultadesCarreras.php';
    include_once '../models/user_session.php';
    require_once '../models/user.php';
    require_once '../models/alumno.php';

    $id = $_REQUEST['id'];
    $logout = "../models/logout.php";

    $userSession = new UserSession();
    $user = new User();

    if (isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser($user));
    }

    $alumno = new Alumno();

    $alumno->setAlumnoByUser($id);
}
?>

<?php
    if ($user->getTipoUsuario() === 1) {
        if (isset($_POST['aceptar'])) {
            echo '
            <form action="" method="POST" class="registro">
                <h2>Editar datos</h2>
                <div class="registro__form">
                    <div class="registro__flex">
                        <p>Apellidos: <br>
                        <input type="text" name="apellidos">
                        </p>
                        <p>Nombres: <br>
                        <input type="text" name="nombres">
                        </p>
                    </div>
                    <p>DNI: <br>
                        <input type="number" name="dni">
                    </p>
                    <p>Email: <br>
                        <input type="email" name="email">
                    </p>
                    <p class="registro__tel">TelÃ©fono: <br>
                        <input type="tel" name="telefono">
                    </p>
                    <p>Seleccione su facultad <br>
                      <select name="facultad">';
                      foreach ($facultades as &$fac){
                        echo '<option value="' .$fac->getNombre() .'">' .$fac->getNombre() .'</option>';
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

            echo '
                <form action="" method="POST" class="registro">
                    <h2>Datos Ingresados</h2>
                    <p class="precaucion"><b>Por favor, revise los datos con precauciÃ³n antes de aceptar los cambios. No podrÃ¡ volver a editarlos en el futuro:</b></p>
                    <p><b>Nombre:</b> ' .$nombres .'</p>
                    <p><b>Apellido:</b> ' .$apellidos .'</p>
                    <p><b>DNI:</b> ' .$dni .'</p>
                    <p><b>Email:</b> ' .$email .'</p>
                    <p><b>Telefono:</b> ' .$telefono .'</p>
                    <p><b>Facultad:</b> ' .$facultad .'</p>
                    <p><b>Carrera:</b> ' .$carrera .'</p>
                    <p><b>AÃ±o de ingreso:</b> ' .$ingreso .'</p>
                    <p><b>Promedio:</b> ' .$promedio .'</p>
                    <p><b>Materias aprobadas el Ãºltimo ciclo lectivo:</b> ' .$aprobadas .'</p>
                    <p><b>ExÃ¡menes rendidos:</b> ' .$rendidos .'</p>
                    <p><b>Cantidad de materias de la carrera:</b> ' .$totales .'</p>
                    <p><b>Ingresos del grupo familiar:</b> ' .$ingresos .'</p>
                    <p><b>Egresos del grupo familiar:</b> ' .$egresos .'</p>
                    <p><b>Integrantes del grupo familiar:</b> ' .$integrantes .'</p>
                    <p>Â¿Guardar cambios?</p>

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

            $alumno->editarAlumno($id, $facultad, $apellidos, $nombres, $dni, $email, $telefono, $carrera, $ingreso, $promedio, $aprobadas, $totales, $rendidos, $ingresos, $egresos, $integrantes);

            header("Location: ../index.php");
        } else if (isset($_POST['facultad']) && isset($_POST['nombres']) && isset($_POST['apellidos']) && isset($_POST['dni']) && isset($_POST['email']) && !isset($_POST['carrera'])){
            if ($_POST['nombres'] === '' || $_POST['apellidos'] === '' || $_POST['dni'] === '' || $_POST['email'] === ''){
                echo '
                <div class="incorrecto" style="margin-left: 50px; padding-top: 90px;">
                    <form action="" method="POST">
                        ERROR: Para editar sus datos, deberÃ¡ completar todos los campos. Por favor, intente nuevamente.
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
                    <h2>Editar datos</h2>
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
                                echo '<option value="' .$carr .'">' .$carr .'</option>';
                            };
                        echo '</select>
                        </p>
                        <p>AÃ±o de ingreso a la facultad: <br>
                            <input type="number" name="ingreso">
                        </p>
                        <p>Promedio (Separar decimales con punto. <b>Ejemplo: 8.50</b>): <br>
                            <input type="number" step="0.01" name="promedio">
                        </p>
                        <p>Cantidad de materias aprobadas en el Ãºltimo ciclo lectivo <br><b>(Del 01/04/2018 al 31/03/2019)</b>: <br>
                            <input type="number" name="aprobadas">
                        </p>
                        <p>Cantidad de materias de la carrera: <br>
                            <input type="number" name="totales">
                        </p>
                        <p>Cantidad de examenes rendidos en total: <br>
                            <input type="number" name="rendidos">
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
                                ERROR: Los datos ingresados son invÃ¡lidos. Por favor intente nuevamente.
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
                        echo '
                        <form action="" method="POST" class="registro">
                            <h2>Datos Familiares</h2>
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
                            Ingresos totales en pesos (Sumatoria de los ingresos econÃ³micos de todos los integrantes del grupo familiar. Escriba el nÃºmero <b>sin puntos</b>, salvo para indicar centavos): <br>
                                <div class="monto">
                                <span>$</span>
                                <input type="number" step="0.01" name="ingresos">
                                </div>
                            </p>
                            <p>Egresos totales en pesos (Sumatoria de los servicios, impuestos y crÃ©ditos del grupo familiar. Escriba el nÃºmero <b>sin puntos</b>, salvo para indicar centavos):  <br>
                                <div class="monto">
                                <span>$</span>
                                <input type="number" step="0.01" name="egresos">
                                </div>
                            </p>
                            <p>Cantidad de integrantes de su grupo familiar (ContÃ¡ndose a usted mismo): <br>
                                <input type="number" name="integrantes">
                            </p>
                            <div class="registro__button">
                                <input type="submit" value="Siguiente" class="button">
                            </div>
                            </div>
                        </form>
                      ';
                    }
                } else {
                    echo '
                    <div class="incorrecto" style="margin-left: 50px; padding-top: 90px;">
                        <form action="" method="POST">
                            ERROR: Para editar sus datos, deberÃ¡ completar todos los campos. Por favor, intente nuevamente.
                            <br>
                            <select name="aceptar" style="display:none;">
                                <option value="aceptar">true</option>
                            </select>
                            <input type="submit" value="Reintentar" class="button" style="margin-top: 20px;">
                        </form>
                    </div>';
                }
            } else {
            echo 
            '
            <div class="solicitud__background">
                <form action="" method="POST">
                    <div class="editar__warning">
                        <select name="aceptar" style="display:none;">
                            <option value="aceptar">true</option>
                        </select>
                        <h2 class="warning">ATENCIÃ“N</h2>
                        <p class="editar__p">Usted podrÃ¡ editar sus datos <b style="color: red;">sÃ³lo una vez</b></p>
                        <p class="editar__p">Una vez editados sus datos, se deshabilitarÃ¡ el botÃ³n de ediciÃ³n y su informaciÃ³n no podrÃ¡ ser cambiada en el futuro, por lo que se pide precauciÃ³n al acceder a esta funcionalidad.</p>
                        <p class="editar__p">Â¿Desea continuar?</p>
                        <div class="editar__buttons">
                            <input type="submit" value="Continuar" class="button"/>
                            <a class="button registrarse" onclick="location=`../index.php`">Atras</a>
                        </div>
                </div>
            </form>
            ';
        }
    }
?>

