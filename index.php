<?php
/*
    $dominio = "localhost";
    $nombreusuario = "root";
    $password = "gbalsells";
    $db = "jbteran";

    $conexion = new mysqli($dominio, $nombreusuario, $password, $db);

    if ($conexion -> connect_error) {
        die("Conexion fallida: " . $conexion -> connect_error);
    }

    //$Usuario = {null, "Gonzalo", "Cortez", "gcortez@gmail.com", 0, 3814269};
    //$sql = "INSERT INTO Usuario VALUES (null, 'Papito', 'Cortez', 'gcortez@gmail.com', 0, 3814269)";

    $sql = "SELECT * FROM Usuario WHERE IdUsuario = 1";
    $resultado = $conexion->query($sql);
    if ($conexion->query($sql) === true) {
        echo "VAMO PAPA";
    } else {
        echo $conexion ->error;
    }

    */

    include_once 'models/user.php';
    include_once 'models/user_session.php';

    $userSession = new UserSession();
    $user = new User();

    if (isset($_SESSION['user'])){
        $user->setUser($userSession->getCurrentUser($user));
        include_once 'pages/home.php';
    } else if (isset($_POST['usuario']) && isset($_POST['password'])){
        $userForm = $_POST['usuario'];
        $passForm = $_POST['password'];

        if($user->userExists($userForm, $passForm)){
            $userSession->setCurrentUser($userForm);
            $user->setUser($userForm);
            if($user->getTipoUsuario() === 0) {
                echo $user->getIdUsuario();
            }
            include_once 'pages/home.php';
        } else {
            echo "Usuario y/o contraseña incorrecta";
            include_once 'pages/login.php';
        }
    } else {
        include_once 'pages/login.php';
    }
?>