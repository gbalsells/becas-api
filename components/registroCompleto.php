<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro exitoso - Becas UNT</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <?php
        if ($_REQUEST['beca'] === '0') {
        $beca = 'Juan B. Terán';
        } else {
        $beca = 'Conectividad';
        }
        echo '
        <nav class="top-bar logos">
              <div class="top-bar__unt">
                <img src="../assets/unt.png" alt="" style="padding:10px;">          
              </div>
              <a onclick="location=`../index.php`" class="titulo">Becas ' .$beca .' - UNT</a>
              <div class="top-bar__organismos">
                <img src="../assets/sae3.png" alt="" style="padding:10px;">          
              </div>
          </nav>
          <div class="solicitud__background">
              <div class="solicitud__text">
                  <h2>¡Se ha registrado exitosamente!</h2>
                  <p>Para solicitar la Beca ' .$beca .', deberá ingresar al sistema y completar el formulario de solicitud. </p>
                  <p>Para iniciar sesión y comenzar a completarlo, haga click <a class="link" onclick="location=`../index.php`">aquí</a></p>
              </div>
          </div>
        ';
        
    ?>
</body>
</html>
