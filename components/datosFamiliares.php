<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - Becas Juan B. Teran</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
<?php 
include_once 'models/alumno.php';
$alumno = new Alumno();
$id = $user->getIdUsuario();
$esBecaConectar = $user->getBeca();
if($esBecaConectar) {
  if(isset($_POST['primerPaso'])) {
    if (isset($_POST['ingresos']) && isset($_POST['tieneHijos']) && isset($_POST['telefono4G'])
      && isset($_POST['telefonoLiberado']) && isset($_POST['compania']) && isset($_POST['mejorCompania'])
      && isset($_POST['vulnerabilidad']) && isset($_POST['integrantes'])){
        if ($_POST['tieneHijos'] === '1' && ($_POST['cantidadHijos'] === '0' || $_POST['cantidadHijos'] === '')) {
          $mensajeHijos = 'Debe indicar cuántos hijos tiene';
        }
        if ($_POST['vulnerabilidad'] === 'Si' && $_POST['descripcionVulnerabilidad'] === '') {
          $mensajeVulnerabilidad = 'Debe describir su condición de vulnerabilidad';
        }
        if (isset($mensajeHijos) || isset($mensajeVulnerabilidad)) {
          echo '
          <form action="" method="POST" class="registro">
            <h2>Datos familiares y tecnológicos arada</h2>
            <div class="registro__form familiares">
            <div class="incorrecto" style="padding-left: 0px;">';
            if(isset($mensajeHijos)) {
              echo $mensajeHijos;
            }
            echo '</div>
            <div class="incorrecto" style="padding-left: 0px;">';
            if(isset($mensajeVulnerabilidad)) {
              echo $mensajeVulnerabilidad;
            }
            echo '</div>
            <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
                <input type="number" name="integrantes">
              </p>
              <p>¿Tiene hijos?
                <div class="registro__form hijos">
                  <div>
                    <input type="radio" id="male" name="tieneHijos" value="1">
                    <label for="1">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" id="male" name="tieneHijos" value="0">
                    <label for="0">No</label><br>
                  </div>
                </div>
              </p>
              <p>En caso afirmativo, ¿Cuántos hijos tiene? <br>
                <input type="number" name="cantidadHijos">
              </p>
              <p>Los ingresos de su grupo familiar provienen: <br>
                <select name="ingresos">
                  <option value="Mercado informal de trabajo">Del mercado informal de trabajo</option>
                  <option value="Planes y Asignaciones Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</option>
                  <option value="Categorías de Monotributo A y B">De las categorías de Monotributo A y B</option>
                  <option value="Empleados estatales Nacionales">Empleados estatales Nacionales</option>
                  <option value="Empleados estatales Provinciales">Empleados estatales Provinciales</option>
                  <option value="Empleados estatales Municipales">Empleados estatales Municipales</option>
                  <option value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</option>
                </select>
              </p>
              <p>¿Tiene teléfono 4G?
                <div class="registro__form hijos">
                  <div>
                    <input type="radio" id="male" name="telefono4G" value="Si">
                    <label for="Si">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" id="male" name="telefono4G" value="No">
                    <label for="No">No</label><br>
                  </div>
                </div>
              </p>
              <p>¿Su teléfono celular es liberado?
                <div class="registro__form hijos">
                  <div>
                    <input type="radio" id="male" name="telefonoLiberado" value="Si">
                    <label for="Si">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" id="male" name="telefonoLiberado" value="No">
                    <label for="No">No</label><br>
                  </div>
                </div>
              </p>
              <p>Compañía que posee actualmente: <br>
                <select name="compania">
                  <option value="Personal">Personal</option>
                  <option value="Movistar">Movistar</option>
                  <option value="Claro">Claro</option>
                  <option value="Tuenti">Tuenti</option>
                </select>
              </p>
              <p>¿Qué compañía es la que mejor cobertura tiene en la zona donde resides actualmente? <br>
                <select name="mejorCompania">
                  <option value="Personal">Personal</option>
                  <option value="Movistar">Movistar</option>
                  <option value="Claro">Claro</option>
                  <option value="Tuenti">Tuenti</option>
                </select>
              </p>
              <p>¿Presentas indicadores de vulnerabilidad?
                <div class="registro__form vulnerabilidad">
                  <div>
                    <input type="radio" id="male" name="vulnerabilidad" value="Si">
                    <label for="Si">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" id="male" name="vulnerabilidad" value="No">
                    <label for="No">No</label><br>
                  </div>
                  <div>
                    <input type="radio" id="male" name="vulnerabilidad" value="NC">
                    <label for="NC">No deseo contestar</label><br>
                  </div>
                </div>
              </p>
              <p>En caso de responder afirmativamente la pregunta anterior, describa brevemente el mismo: <br>
                <input type="text" name="descripcionVulnerabilidad">
              </p>
              <select name="primerPaso" style="display:none;">
                <option value="1">PrimerPaso</option>
              </select>
              <div class="registro__button">
                <input type="submit" value="Siguiente" class="button">
              </div>
            </div>
          </form>';
        } else {
          $ingresos = $_POST['ingresos'];
          $telefono4G = $_POST['telefono4G'];
          $telefonoLiberado = $_POST['telefonoLiberado'];
          $compania = $_POST['compania'];
          $mejorCompania = $_POST['mejorCompania'];
          $integrantes = $_POST['integrantes'];
          $hijos = 0;
          if($_POST['tieneHijos'] === '1' ) {
            $hijos = $_POST['cantidadHijos'];
          }
          $vulnerabilidad = 'No';
          if($_POST['vulnerabilidad'] === 'Si' ) {
            $vulnerabilidad = $_POST['descripcionVulnerabilidad'];
          }
          echo $ingresos, $telefono4G, $telefonoLiberado, $compania, $mejorCompania, $integrantes, $hijos, $vulnerabilidad;
          $alumno->datosFamiliaresConectar($id, $integrantes, $hijos, $ingresos, $telefono4G, $telefonoLiberado, $compania, $mejorCompania, $vulnerabilidad);
          header("Location: components/solicitudEnviada.php");
        }
      } else {
        echo '
        <form action="" method="POST" class="registro">
          <h2>Datos familiares y tecnológicos arada</h2>
          <div class="registro__form familiares">
          <div class="incorrecto" style="padding-left: 0px;">Debe ingresar todos los datos</div>
            <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
              <input type="number" name="integrantes">
            </p>
            <p>¿Tiene hijos?
              <div class="registro__form hijos">
                <div>
                  <input type="radio" id="male" name="tieneHijos" value="1">
                  <label for="1">Si</label><br>
                </div>
                <div>
                  <input type="radio" id="male" name="tieneHijos" value="0">
                  <label for="0">No</label><br>
                </div>
              </div>
            </p>
            <p>En caso afirmativo, ¿Cuántos hijos tiene? <br>
              <input type="number" name="cantidadHijos">
            </p>
            <p>Los ingresos de su grupo familiar provienen: <br>
              <select name="ingresos">
                <option value="Mercado informal de trabajo">Del mercado informal de trabajo</option>
                <option value="Planes y Asignaciones Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</option>
                <option value="Categorías de Monotributo A y B">De las categorías de Monotributo A y B</option>
                <option value="Empleados estatales Nacionales">Empleados estatales Nacionales</option>
                <option value="Empleados estatales Provinciales">Empleados estatales Provinciales</option>
                <option value="Empleados estatales Municipales">Empleados estatales Municipales</option>
                <option value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</option>
              </select>
            </p>
            <p>¿Tiene teléfono 4G?
              <div class="registro__form hijos">
                <div>
                  <input type="radio" id="male" name="telefono4G" value="Si">
                  <label for="Si">Si</label><br>
                </div>
                <div>
                  <input type="radio" id="male" name="telefono4G" value="No">
                  <label for="No">No</label><br>
                </div>
              </div>
            </p>
            <p>¿Su teléfono celular es liberado?
              <div class="registro__form hijos">
                <div>
                  <input type="radio" id="male" name="telefonoLiberado" value="Si">
                  <label for="Si">Si</label><br>
                </div>
                <div>
                  <input type="radio" id="male" name="telefonoLiberado" value="No">
                  <label for="No">No</label><br>
                </div>
              </div>
            </p>
            <p>Compañía que posee actualmente: <br>
              <select name="compania">
                <option value="Personal">Personal</option>
                <option value="Movistar">Movistar</option>
                <option value="Claro">Claro</option>
                <option value="Tuenti">Tuenti</option>
              </select>
            </p>
            <p>¿Qué compañía es la que mejor cobertura tiene en la zona donde resides actualmente? <br>
              <select name="mejorCompania">
                <option value="Personal">Personal</option>
                <option value="Movistar">Movistar</option>
                <option value="Claro">Claro</option>
                <option value="Tuenti">Tuenti</option>
              </select>
            </p>
            <p>¿Presentas indicadores de vulnerabilidad?
              <div class="registro__form vulnerabilidad">
                <div>
                  <input type="radio" id="male" name="vulnerabilidad" value="Si">
                  <label for="Si">Si</label><br>
                </div>
                <div>
                  <input type="radio" id="male" name="vulnerabilidad" value="No">
                  <label for="No">No</label><br>
                </div>
                <div>
                  <input type="radio" id="male" name="vulnerabilidad" value="NC">
                  <label for="NC">No deseo contestar</label><br>
                </div>
              </div>
            </p>
            <p>En caso de responder afirmativamente la pregunta anterior, describa brevemente el mismo: <br>
              <input type="text" name="descripcionVulnerabilidad">
            </p>
            <select name="primerPaso" style="display:none;">
              <option value="1">PrimerPaso</option>
            </select>
            <div class="registro__button">
              <input type="submit" value="Siguiente" class="button">
            </div>
          </div>
        </form>';
      }
  } else {
    echo '
    <form action="" method="POST" class="registro">
    <h2>Datos familiares y tecnológicos asada</h2>
      <div class="registro__form familiares">
        <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
          <input type="number" name="integrantes">
        </p>
        <p>¿Tiene hijos?
          <div class="registro__form hijos">
            <div>
              <input type="radio" id="male" name="tieneHijos" value="1">
              <label for="1">Si</label><br>
            </div>
            <div>
              <input type="radio" id="male" name="tieneHijos" value="0">
              <label for="0">No</label><br>
            </div>
          </div>
        </p>
        <p>En caso afirmativo, ¿Cuántos hijos tiene? <br>
          <input type="number" name="cantidadHijos">
        </p>
        <p>Los ingresos de su grupo familiar provienen: <br>
          <select name="ingresos">
            <option value="Mercado informal de trabajo">Del mercado informal de trabajo</option>
            <option value="Planes y Asignaciones Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</option>
            <option value="Categorías de Monotributo A y B">De las categorías de Monotributo A y B</option>
            <option value="Empleados estatales Nacionales">Empleados estatales Nacionales</option>
            <option value="Empleados estatales Provinciales">Empleados estatales Provinciales</option>
            <option value="Empleados estatales Municipales">Empleados estatales Municipales</option>
            <option value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</option>
          </select>
        </p>
        <p>¿Tiene teléfono 4G?
          <div class="registro__form hijos">
            <div>
              <input type="radio" id="male" name="telefono4G" value="Si">
              <label for="Si">Si</label><br>
            </div>
            <div>
              <input type="radio" id="male" name="telefono4G" value="No">
              <label for="No">No</label><br>
            </div>
          </div>
        </p>
        <p>¿Su teléfono celular es liberado?
          <div class="registro__form hijos">
            <div>
              <input type="radio" id="male" name="telefonoLiberado" value="Si">
              <label for="Si">Si</label><br>
            </div>
            <div>
              <input type="radio" id="male" name="telefonoLiberado" value="No">
              <label for="No">No</label><br>
            </div>
          </div>
        </p>
        <p>Compañía que posee actualmente: <br>
          <select name="compania">
            <option value="Personal">Personal</option>
            <option value="Movistar">Movistar</option>
            <option value="Claro">Claro</option>
            <option value="Tuenti">Tuenti</option>
          </select>
        </p>
        <p>¿Qué compañía es la que mejor cobertura tiene en la zona donde resides actualmente? <br>
          <select name="mejorCompania">
            <option value="Personal">Personal</option>
            <option value="Movistar">Movistar</option>
            <option value="Claro">Claro</option>
            <option value="Tuenti">Tuenti</option>
          </select>
        </p>
        <p>¿Presentas indicadores de vulnerabilidad?
          <div class="registro__form vulnerabilidad">
            <div>
              <input type="radio" id="male" name="vulnerabilidad" value="Si">
              <label for="Si">Si</label><br>
            </div>
            <div>
              <input type="radio" id="male" name="vulnerabilidad" value="No">
              <label for="No">No</label><br>
            </div>
            <div>
              <input type="radio" id="male" name="vulnerabilidad" value="NC">
              <label for="NC">No deseo contestar</label><br>
            </div>
          </div>
        </p>
        <p>En caso de responder afirmativamente la pregunta anterior, describa brevemente el mismo: <br>
          <input type="text" name="descripcionVulnerabilidad">
        </p>
        <select name="primerPaso" style="display:none;">
          <option value="1">PrimerPaso</option>
        </select>
        <div class="registro__button">
          <input type="submit" value="Siguiente" class="button">
        </div>
      </div>
    </form>';
  }
} else {
  echo '
  <form action="" method="POST" class="registro">
    <h2>Datos Familiares</h2>
    <div class="registro__form familiares">
      <p>
      Ingresos totales en pesos (Sumatoria de los ingresos económicos de todos los integrantes del grupo familiar. Escriba el número <b>sin puntos</b>, salvo para indicar centavos): <br>
        <div class="monto">
          <span>$</span>
          <input type="number" step="0.01" name="ingresos">
        </div>
      </p>
      <p>Egresos totales en pesos (Sumatoria de los servicios, impuestos y créditos del grupo familiar. Escriba el número <b>sin puntos</b>, salvo para indicar centavos):  <br>
        <div class="monto">
          <span>$</span>
          <input type="number" step="0.01" name="egresos">
        </div>
      </p>
      <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
        <input type="number" name="integrantes">
      </p>
      <div class="registro__button">
        <input type="submit" value="Siguiente" class="button">
      </div>
    </div>
  </form>';
  if (isset($_POST['ingresos']) && isset($_POST['egresos']) && isset($_POST['integrantes'])){
    $ingresos = $_POST['ingresos'];
    $egresos = $_POST['egresos'];
    $integrantes = $_POST['integrantes'];
    $alumno->datosFamiliares($id, $ingresos, $egresos, $integrantes);
    header("Location: components/solicitudEnviada.php");
  }
}
?>
  
</body>
</html>
