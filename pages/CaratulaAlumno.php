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
    <nav class="top-bar">
        Bienvenido, <?php echo $user->getNombre(); ?>
        <a href="models/logout.php">Cerrar sesión</a>
    </nav>
    <div class="caratula">
        <div class="caratula__contenido">
            <div class="caratula__header">
                <span class="caratula__header__nombre"><?php echo $user->getApellido() .', ' .$user->getNombre(); ?></span>
                <span class="caratula__header__estado">Solicitud enviada</span>
            </div>
            <div class="caratula__datos">
                <h3>Datos personales</h3>
                <ul class="caratula__datos__info">
                    <li><b>DNI: </b><?php echo $user->getDNI();?></li>
                    <li><b>Email: </b><?php echo $user->getEmail();?></li>
                    <li><b>Telefono: </b><?php echo $user->getTelefono();?></li>
                </ul>
                <h3>Datos académicos</h3>
                <ul class="caratula__datos__info">
                    <li><b>Facultad: </b>Facultad de Ciencias Exactas y tecnología</li>
                    <li><b>Carrera: </b>Ingeniería en Computación</li>
                    <li><b>Cantidad de materias de la carrera: </b>42</li>
                    <li><b>Año de ingreso a la facultad: </b>2014</li>
                    <li><b>Promedio: </b>8,4</li>
                    <li><b>Materias aprobadas el último ciclo lectivo: </b>4</li>
                    <li><b>Cantidad de materias rendidas: </b>10</li>


                </ul>
                <h3>Datos familiares</h3>
                <ul class="caratula__datos__info">
                    <li><b>Ingresos: </b>$70.000</li>
                    <li><b>Egresos: </b>$10.000</li>
                    <li><b>Integrantes del grupo familiar: </b>5</li>
                </ul>
            </div>
    </div>
</body>
</html>