<?php
class LogoutController{

    private $db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){
        $_SESSION = array(); #vide la variable session
        header("Location: index.php"); #redirige vers la page d'accueil
        die();
    }
}