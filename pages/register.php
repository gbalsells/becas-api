<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sesiones</title>
    <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <nav class="top-bar">
        <div><img src="../assets/sae.jpg" /></div>
        <div>Becas Juan B Terán</div>
        <div><img src="../assets/unt.jpg" /></div>
    </nav>
    <form action="" method="POST" class="registro">
        <?php
            if(isset($errorLogin)){
                echo $errorLogin;
            }
        ?>
        <h2>Registrarse</h2>
        <p>Nombre de usuario: <br>
        <input type="text" name="usuario"></p>

        <p>Password: <br>
        <input type="password" name="password"></p>

        <p>Apellidos: <br>
        <input type="text" name="apellidos"></p>

        <p>Nombres: <br>
        <input type="text" name="nombres"></p>

        <p>DNI: <br>
        <input type="number" name="dni"></p>

        <p>Email: <br>
        <input type="email" name="email"></p>

        <p>Telefono: <br>
        <input type="tel" name="telefono"></p>

        <p class="center"><input type="submit" value="Registrarse"></p>
    </form>
</body>
</html>