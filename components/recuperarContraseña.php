<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Becas Juan B. Teran</title>
    <link rel="shortcut icon" href="http://www.unt.edu.ar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../main.css">
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>

</head>
<body>
    <nav class="top-bar">
        <div class="top-bar__unt">
          <img src="assets/untletras.png" alt="" style="padding:10px;">          
        </div>
        <a onclick="location='index.php'" class="titulo">Becas Juan B Terán</a>
        <div class="top-bar__organismos">
          <span>Secretaría de Asuntos Estudiantiles</span>
          <span>Dirección General de Becas</span>
        </div>
    </nav>
    <div class="login-div">
      <form action="" method="POST" class="login">
          <div class="login__form">
            <h2 id="titulo-reestablecer">Reestablecimiento de contraseña</h2>
            <p>Ingrese su correo electrónico: <br>
              <input type="text" name="email_Rec" class="login__input">
            </p>
            <div class="login__buttons">
              <input type="submit" value="Reestablecer contraseña" class="button" id="btn-reestablecer-pass">
            </div>
          </div>
            
        <?php
          
          
          include_once '../models/db.php';
          $db = new DB();

          if (isset($_POST["email_Rec"])){
              $mail = $_POST["email_Rec"];

              $res = $db->verificarMail($mail);

              if($res->rowCount()){ //existe mail
                //aca envio el mail usando phpmailer
                /*require '../lib/phpmailer/class.phpmailer.php';
                require '../lib/phpmailer/phpmailer-fe.php';
                require '../lib/phpmailer/'
                
                $Email = new PHPMailer();
                $Email->isSMTP();
                $Email->SMTPAuth = true;
                $Email->SMTPSecure = 'ssl';
                $Email->Host = 'localhost/becas/becas-api/';
                $Email->Port = '80';

                $Email->Username = 'cosmokramerff@gmail.com';
                $Email->Password = 'TheDarkPassenger';

                $Email->setFrom('cosmokramerff@gmail.com', 'becas juan b teran');
                $Email->addAdress($mail, 'usuario');

                
                $link = 'localhost/becas/becas-api/components/cambiarContraseña.php';
                $Email->Subject = 'Reestablecimiento de contraseña';
                $Email->Body = 'ola, hace click en el link para reestablecer tu pass: <br>
                <a href="$link">$link</a>';
                $Email->isHTML(true);

                if($Email->send()){
                  include_once '/cartelEnvioMail.php';
                }
                else{
                  echo "<div class='incorrecto'>Hubo un problema al enviar el mail, por favor intenta mas tarde.</div>";
                }
                */

                //prueba 2
                require('../lib/phpmailer/class.phpmailer.php');
                require('../lib/phpmailer/class.smtp.php');

                $Email = new PHPMailer();

                $Email->PluginDir = "../lib/phpmailer/";
                $Email->Mailer = "smtp";
                $Email->Host = "mail.dominio.com";
                $Email->SMTPAuth = true;
                $Email->Username = "micuenta@dominio.com";
                $Email->Password = "mipassword";
                $Email->From = "micuenta@dominio.com";
                $Email->FromName = "Gonzalo";
                $Email->Timeout = 30;
                $Email->AddAddress($mail);
                $Email->Subject = "Probandoooooooooooooooooooo";
                $Email->Body = "<b>mail de prueba</b>";
                $Email->AltBody = "mail de pruebaaaaaaaaa";
                $exito = $Email->Send();

                $intentos=1;

                while ((!$exito) && ($intentos < 5)) { 
                  sleep(5);
                  //echo $mail->ErrorInfo;
                  $exito = $Email->Send();
                  $intentos=$intentos+1;
                }

                if(!$exito) {
                  echo "Problemas enviando correo electrónico";
                }
                else {
                  echo "Mensaje enviado correctamente";  
                }
          }
          else{
            echo "<div class='incorrecto' id='alerta-mail'>El mail ingresado no existe en nuestra base de datos.</div>";
          }
        }
        ?>
      </form>
    </div> 
</body>
</html>