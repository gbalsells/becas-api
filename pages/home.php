<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Becas Juan B. Teran</title>
</head>
<body>

    <?php
    if ($user->getTipoUsuario() === 0) {
        include_once 'components/listaAlumnos.php';
    } else {
        include_once 'components/datosAcademicos.php';
    }
    ?>
</body>
</html>