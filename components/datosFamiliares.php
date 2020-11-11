<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro - Becas UNT</title>
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
if($esBecaConectar === 1) {
  if(isset($_POST['primerPaso'])) {
    if (isset($_POST['ingresos']) && isset($_POST['tieneHijos']) && isset($_POST['telefono4G'])
      && isset($_POST['telefonoLiberado']) && isset($_POST['compania']) && isset($_POST['mejorCompania'])
      && isset($_POST['vulnerabilidad']) && isset($_POST['integrantes']) && isset($_POST['familiaresInternet'])){
        if (isset($_POST['juramento1']) && isset($_POST['juramento2']) && isset($_POST['juramento3'])) {
          $valido = true;
        } else {
          $valido = false;
          $mensajeJuramento = 'Debe declarar bajo juramento cada uno de los ítems para poder continuar';
        }
        $ingresos = implode(", ",array_unique(array_filter($_POST['ingresos'])));
        if ($ingresos === '' ) {
          $mensajeIngresos = 'Debe indicar al menos una fuente de ingresos';
        }
        if ((int)$_POST['familiaresInternet'] > ((int)$_POST['integrantes'])) {
          $mensajeFamiliares = 'La cantidad de integrantes que utilizan Internet debe ser menor o igual a la cantidad de integrantes de su grupo familiar';
        }
        if ($_POST['tieneHijos'] === '1' && ($_POST['cantidadHijos'] === '')) {
          $mensajeHijos = 'Debe indicar a quién tiene a cargo';
        }
        if ($_POST['vulnerabilidad'] === 'Si' && $_POST['descripcionVulnerabilidad'] === '') {
          $mensajeVulnerabilidad = 'Debe describir su condición de vulnerabilidad';
        }
        if ($_POST['integrantes'] === '0' || $_POST['integrantes'] === '') {
          $mensajeIntegrantes = 'Debe indicar los integrantes de su familia';
        }
        if (isset($mensajeHijos) || isset($mensajeVulnerabilidad) || isset($mensajeIntegrantes) || isset($mensajeIngresos) || isset($mensajeFamiliares) || $valido === false) {
          echo '
          <form action="" method="POST" class="registro">
            <h2>Otros datos</h2>
            <div class="registro__form familiares">';
            if(isset($mensajeFamiliares)) {
              echo'
              <div class="incorrecto" style="padding-left: 0px;">'
                .$mensajeFamiliares 
              .'</div>';
            }
            if(isset($mensajeJuramento)) {
              echo'
              <div class="incorrecto" style="padding-left: 0px;">'
                .$mensajeJuramento 
              .'</div>';
            }
            if(isset($mensajeIngresos)) {
              echo'
              <div class="incorrecto" style="padding-left: 0px;">'
                .$mensajeIngresos 
              .'</div>';
            }
            if(isset($mensajeHijos)) {
              echo'
              <div class="incorrecto" style="padding-left: 0px;">'
                .$mensajeHijos 
              .'</div>';
            }
            if(isset($mensajeVulnerabilidad)) {
              echo'
              <div class="incorrecto" style="padding-left: 0px;">'
                .$mensajeVulnerabilidad 
              .'</div>';
            }
            if(isset($mensajeIntegrantes)) {
              echo '
              <div class="incorrecto" style="padding-left: 0px;">'
                .$mensajeIntegrantes
                .'</div>';
              }
            echo '
              <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
                <input type="number" name="integrantes">
              </p>
              <p>¿Cuántas personas del grupo familiar usan Internet por cuestiones académicas?: <br>
                <input type="number" name="familiaresInternet">
              </p>
              <p>¿Tiene personas a su cargo?
                <div class="registro__form hijos">
                  <div>
                    <input type="radio" name="tieneHijos" value="1">
                    <label for="1">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" name="tieneHijos" value="0">
                    <label for="0">No</label><br>
                  </div>
                </div>
              </p>
              <p>En caso afirmativo, ¿A quién tiene a cargo?<br>
                <input name="cantidadHijos">
              </p>
              <p>Los ingresos de su grupo familiar provienen:</p>
              <div class="ingresos">
                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Mercado informal de trabajo">Del mercado informal de trabajo</input> <br>
                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Planes Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</input> <br>
                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Monotributo">De las categorías de Monotributo A y B</input> <br>
                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</input> <br>
                <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Otros">Otros</input>
              </div>
              <p>¿Tiene teléfono 4G?
                <div class="registro__form hijos">
                  <div>
                    <input type="radio" name="telefono4G" value="Si">
                    <label for="Si">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" name="telefono4G" value="No">
                    <label for="No">No</label><br>
                  </div>
                </div>
              </p>
              <p>¿Su teléfono celular es liberado?
                <div class="registro__form hijos">
                  <div>
                    <input type="radio" name="telefonoLiberado" value="Si">
                    <label for="Si">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" name="telefonoLiberado" value="No">
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
                  <option value="No se">No sé</option>
                </select>
              </p>
              <p>¿Presentas indicadores de vulnerabilidad?
                <div class="registro__form vulnerabilidad">
                  <div>
                    <input type="radio" name="vulnerabilidad" value="Si">
                    <label for="Si">Si</label><br>
                  </div>
                  <div>
                    <input type="radio" name="vulnerabilidad" value="No">
                    <label for="No">No</label><br>
                  </div>
                  <div>
                    <input type="radio" name="vulnerabilidad" value="NC">
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
              <div class="ingresos" style="font-weight: bold;">
                <p>DECLARO BAJO JURAMENTO:</p>
                <input type="checkbox" name="juramento1" value="true">QUE LOS DATOS ARRIBA CONSIGNADOS SON FEHACIENTES</option> <br>
                <input type="checkbox" name="juramento2" value="true">QUE LOS INGRESOS DE MI GRUPO FAMILIAR CONVIVIENTE ES MENOR O IGUAL A 3 SALARIOS MINIMO VITALY MOVIL. (S.M.V.M del mes de octubre 2020 $18.900)</option> <br>
                <input type="checkbox" name="juramento3" value="true">NO CONTAR CON CONECTIVIDAD A INTERNET EN EL DOMICILIO DONDE ME ENCUENTRO CUMPLIMENTANDO LA MEDIDA DE AISLAMIENTO/DISTANCIAMIENTO SOCIAL, PREVENTIVO Y OBLIGATORIO DISPUESTA POR EL GOBIERNO NACIONAL.</option> <br>
              </div>
              <div class="registro__button">
                <input type="submit" value="Siguiente" class="button">
              </div>
            </div>
          </form>';
        } else {
          $telefono4G = $_POST['telefono4G'];
          $telefonoLiberado = $_POST['telefonoLiberado'];
          $compania = $_POST['compania'];
          $mejorCompania = $_POST['mejorCompania'];
          $integrantes = $_POST['integrantes'];
          $familiaresInternet = $_POST['familiaresInternet'];
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
          $alumno->datosFamiliaresConectar($id, $integrantes, $hijos, $ingresos, $telefono4G, $telefonoLiberado, $compania, $mejorCompania, $vulnerabilidad, $familiaresInternet);
          header("Location: components/solicitudEnviada.php");
        }
      } else {
        echo '
        <form action="" method="POST" class="registro">
          <h2>Otros datos</h2>
          <div class="registro__form familiares">
          <div class="incorrecto" style="padding-left: 0px;">Debe ingresar todos los datos</div>
            <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
              <input type="number" name="integrantes">
            </p>
            <p>¿Cuántas personas del grupo familiar usan Internet por cuestiones académicas?: <br>
              <input type="number" name="familiaresInternet">
            </p>
            <p>¿Tiene personas a su cargo? 
              <div class="registro__form hijos">
                <div>
                  <input type="radio" name="tieneHijos" value="1">
                  <label for="1">Si</label><br>
                </div>
                <div>
                  <input type="radio" name="tieneHijos" value="0">
                  <label for="0">No</label><br>
                </div>
              </div>
            </p>
            <p>En caso afirmativo, ¿A quién tiene a cargo? <br>
              <input name="cantidadHijos">
            </p>
            <p>Los ingresos de su grupo familiar provienen:</p>
            <div class="ingresos">
              <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Mercado informal">Del mercado informal de trabajo</input> <br>
              <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Planes Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</input> <br>
              <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Monotributo">De las categorías de Monotributo A y B</input> <br>
              <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</input> <br>
              <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Otros">Otros</input>
            </div>
            <p>¿Tiene teléfono 4G?
              <div class="registro__form hijos">
                <div>
                  <input type="radio" name="telefono4G" value="Si">
                  <label for="Si">Si</label><br>
                </div>
                <div>
                  <input type="radio" name="telefono4G" value="No">
                  <label for="No">No</label><br>
                </div>
              </div>
            </p>
            <p>¿Su teléfono celular es liberado?
              <div class="registro__form hijos">
                <div>
                  <input type="radio" name="telefonoLiberado" value="Si">
                  <label for="Si">Si</label><br>
                </div>
                <div>
                  <input type="radio" name="telefonoLiberado" value="No">
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
                <option value="No se">No sé</option>
              </select>
            </p>
            <p>¿Presentas indicadores de vulnerabilidad?
              <div class="registro__form vulnerabilidad">
                <div>
                  <input type="radio" name="vulnerabilidad" value="Si">
                  <label for="Si">Si</label><br>
                </div>
                <div>
                  <input type="radio" name="vulnerabilidad" value="No">
                  <label for="No">No</label><br>
                </div>
                <div>
                  <input type="radio" name="vulnerabilidad" value="NC">
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
            <div class="ingresos" style="font-weight: bold;">
              <p>DECLARO BAJO JURAMENTO:</p>
              <input type="checkbox" name="juramento1" value="true">QUE LOS DATOS ARRIBA CONSIGNADOS SON FEHACIENTES</option> <br>
              <input type="checkbox" name="juramento2" value="true">QUE LOS INGRESOS DE MI GRUPO FAMILIAR CONVIVIENTE ES MENOR O IGUAL A 3 SALARIOS MINIMO VITALY MOVIL. (S.M.V.M del mes de octubre 2020 $18.900)</option> <br>
              <input type="checkbox" name="juramento3" value="true">NO CONTAR CON CONECTIVIDAD A INTERNET EN EL DOMICILIO DONDE ME ENCUENTRO CUMPLIMENTANDO LA MEDIDA DE AISLAMIENTO/DISTANCIAMIENTO SOCIAL, PREVENTIVO Y OBLIGATORIO DISPUESTA POR EL GOBIERNO NACIONAL.</option> <br>
            </div>
            <div class="registro__button">
              <input type="submit" value="Siguiente" class="button">
            </div>
          </div>
        </form>';
      }
  } else {
    echo '
    <form action="" method="POST" class="registro">
    <h2>Otros datos</h2>
      <div class="registro__form familiares">
        <p>Cantidad de integrantes de su grupo familiar (Contándose a usted mismo): <br>
          <input type="number" name="integrantes">
        </p>
        <p>¿Cuántas personas del grupo familiar usan Internet por cuestiones académicas?: <br>
          <input type="number" name="familiaresInternet">
        </p>
        <p>¿Tiene personas a su cargo? 
          <div class="registro__form hijos">
            <div>
              <input type="radio" name="tieneHijos" value="1">
              <label for="1">Si</label><br>
            </div>
            <div>
              <input type="radio" name="tieneHijos" value="0">
              <label for="0">No</label><br>
            </div>
          </div>
        </p>
        <p>En caso afirmativo, ¿A quién tiene a cargo?<br>
          <input name="cantidadHijos">
        </p>
        <p>Los ingresos de su grupo familiar provienen:</p>
        <div class="ingresos">
          <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Mercado informal de trabajo">Del mercado informal de trabajo</input> <br>
          <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Planes Sociales">De transferencias formales del Estado (Planes y Asignaciones Sociales)</input> <br>
          <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Monotributo">De las categorías de Monotributo A y B</input> <br>
          <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Actividades frenadas por pandemia">De actividades laborales que no se están desarrollando en virtud de las medidas de prevención dispuestas por el gobierno nacional en razón de la pandemia</input> <br>
          <input type="checkbox" name="ingresos[]" style="font-weight: lighter;" value="Otros">Otros</input>
        </div>
        <p>¿Tiene teléfono 4G?
          <div class="registro__form hijos">
            <div>
              <input type="radio" name="telefono4G" value="Si">
              <label for="Si">Si</label><br>
            </div>
            <div>
              <input type="radio" name="telefono4G" value="No">
              <label for="No">No</label><br>
            </div>
          </div>
        </p>
        <p>¿Su teléfono celular es liberado?
          <div class="registro__form hijos">
            <div>
              <input type="radio" name="telefonoLiberado" value="Si">
              <label for="Si">Si</label><br>
            </div>
            <div>
              <input type="radio" name="telefonoLiberado" value="No">
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
            <option value="No se">No sé</option>
          </select>
        </p>
        <p>¿Presentas indicadores de vulnerabilidad?
          <div class="registro__form vulnerabilidad">
            <div>
              <input type="radio" name="vulnerabilidad" value="Si">
              <label for="Si">Si</label><br>
            </div>
            <div>
              <input type="radio" name="vulnerabilidad" value="No">
              <label for="No">No</label><br>
            </div>
            <div>
              <input type="radio" name="vulnerabilidad" value="NC">
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
        <div class="ingresos" style="font-weight: bold;">
          <p>DECLARO BAJO JURAMENTO:</p>
          <input type="checkbox" name="juramento1" value="true">QUE LOS DATOS ARRIBA CONSIGNADOS SON FEHACIENTES</option> <br>
          <input type="checkbox" name="juramento2" value="true">QUE LOS INGRESOS DE MI GRUPO FAMILIAR CONVIVIENTE ES MENOR O IGUAL A 3 SALARIOS MINIMO VITALY MOVIL. (S.M.V.M del mes de octubre 2020 $18.900)</option> <br>
          <input type="checkbox" name="juramento3" value="true">NO CONTAR CON CONECTIVIDAD A INTERNET EN EL DOMICILIO DONDE ME ENCUENTRO CUMPLIMENTANDO LA MEDIDA DE AISLAMIENTO/DISTANCIAMIENTO SOCIAL, PREVENTIVO Y OBLIGATORIO DISPUESTA POR EL GOBIERNO NACIONAL.</option> <br>
        </div>
        <div class="registro__button">
          <input type="submit" value="Siguiente" class="button">
        </div>
      </div>
    </form>';
  }
} else {
  if (isset($_POST['vulnerabilidad']) && isset($_POST['tieneHijos']) && isset($_POST['ingresos']) && isset($_POST['egresos']) && isset($_POST['integrantes'])){
    if ($_POST['vulnerabilidad'] === 'Si' && $_POST['descripcionVulnerabilidad'] === '') {
      $mensajeVulnerabilidad = 'Debe describir su condición de vulnerabilidad';
    }
    if ($_POST['ingresos'] === '') {
      $mensajeIngresos = 'Debe indicar la sumatoria de ingresos';
    }
    if ($_POST['egresos'] === 0 || $_POST['egresos'] === '') {
      $mensajeEgresos = 'Debe indicar la sumatoria de egresos';
    }
    if ($_POST['tieneHijos'] === '1' && ($_POST['cantidadHijos'] === '')) {
      $mensajeHijos = 'Debe indicar a quién tiene a cargo';
    }
    if (!isset($mensajeHijos) && !isset($mensajeVulnerabilidad) && !isset($mensajeIntegrantes) && !isset($mensajeIngresos) && !isset($mensajeFamiliares))      {
      $ingresos = $_POST['ingresos'];
      $egresos = $_POST['egresos'];
      $integrantes = $_POST['integrantes'];
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
      $alumno->datosFamiliares($id, $ingresos, $egresos, $integrantes, $hijos, $vulnerabilidad);
      header("Location: components/solicitudEnviada.php");
    }
  }
  echo '
  <form action="" method="POST" class="registro">
      <h2>Otros datos</h2>
      <div class="registro__form familiares">';
      if(isset($mensajeJuramento)) {
        echo'
        <div class="incorrecto" style="padding-left: 0px;">'
          .$mensajeJuramento 
        .'</div>';
      }
      if(isset($mensajeVulnerabilidad)) {
        echo'
        <div class="incorrecto" style="padding-left: 0px;">'
          .$mensajeVulnerabilidad 
        .'</div>';
      }
      if(isset($mensajeIngresos)) {
        echo'
        <div class="incorrecto" style="padding-left: 0px;">'
          .$mensajeIngresos 
        .'</div>';
      }
      if(isset($mensajeEgresos)) {
        echo'
        <div class="incorrecto" style="padding-left: 0px;">'
          .$mensajeEgresos 
        .'</div>';
      }
        echo '
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
      <p>¿Tiene personas a su cargo?
        <div class="registro__form hijos">
          <div>
            <input type="radio" name="tieneHijos" value="1">
            <label for="1">Si</label><br>
          </div>
          <div>
            <input type="radio" name="tieneHijos" value="0">
            <label for="0">No</label><br>
          </div>
        </div>
      </p>
      <p>En caso afirmativo, ¿A quién tiene a cargo?<br>
        <input name="cantidadHijos">
      </p>
      <p>¿Presentas indicadores de vulnerabilidad?
      <div class="registro__form vulnerabilidad">
        <div>
          <input type="radio" name="vulnerabilidad" value="Si">
          <label for="Si">Si</label><br>
        </div>
        <div>
          <input type="radio" name="vulnerabilidad" value="No">
          <label for="No">No</label><br>
        </div>
        <div>
          <input type="radio" name="vulnerabilidad" value="NC">
          <label for="NC">No deseo contestar</label><br>
        </div>
        </div>
        <p>En caso de responder afirmativamente la pregunta anterior, describa brevemente el mismo: <br>
          <input type="text" name="descripcionVulnerabilidad">
        </p>
    </p>
      <div class="registro__button">
        <input type="submit" value="Siguiente" class="button">
      </div>
    </div>
  </form>';
}
?>
  
</body>
</html>
