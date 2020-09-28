<?php
/**
 * Created by PhpStorm.
 * User: killa
 * Date: 21/04/2019
 * Time: 21:13
 */
class SignupController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }
    public function html_spe($unsecure){
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }
    public function run(){

        if (!empty($_SESSION['member'])) {
            header("Location: index.php?action=home");
            die();
        }
        if(empty($_POST)){
            $notif = "Register";
        }
        elseif(empty($_POST['name']) or empty($_POST['last_name']) or empty($_POST['email']) or empty($_POST['password'])){
            $notif= "Please complete all fields";
        }
        elseif($this->_db->exist_user($this->html_spe($_POST['email']))){
            $notif= "This user already exist";
        }
        elseif($this->_db->register_user($this->html_spe($_POST['name']), $this->html_spe($_POST['last_name']), $this->html_spe($_POST['email']), password_hash($_POST['password'], PASSWORD_BCRYPT))){
            header("Location: index.php?action=login");
            die();
        }
        else{
            $notif = "An error is occured";
        }

        require_once (VIEWS_WAY.'signup.php');
    }
}