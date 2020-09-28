<?php
class LoginController{

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }
    public function html_spe($unsecure){
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }
    public function run(){
        #si on est déjà connecté, on retourne sur la page d'accueil
        if (!empty($_SESSION['member'])) {
            header("Location: index.php?action=home");
            die();
        }

        $notif='';
        #si le formulaire est vide, on affiche login
        if (empty($_POST)) {
            $notif='Login';
        } ##on vérifie si l'utilisateur existe et si il existe si il est suspendu
        elseif(!$this->_db->active_user($this->html_spe($_POST['email']))) {
            $notif = 'This user doesn\'t exist or is suspended';
        } #On vérifie si l'email et le mdp vont ensemble
        elseif (!$this->_db->connect_user($this->html_spe($_POST['email']),$this->html_spe($_POST['password']))) {
            $notif='Wrong password';
        } else {
            header("Location: index.php?action=home");
            die();
        }
        require_once(VIEWS_WAY.'login.php');
    }
}