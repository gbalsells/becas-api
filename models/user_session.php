<?php

class UserSession{

    public function __construct(){
        session_start();
    }

    public function setCurrentuser($user){
        $_SESSION['user'] = $user;
    }

    public function setAlumno($alumno){
        $_SESSION['alumno'] = $alumno;
    }

    public function setMerito($merito){
        $_SESSION['merito'] = $merito;
    }
    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}
?>