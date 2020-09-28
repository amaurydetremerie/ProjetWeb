<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 24-04-19
 * Time: 16:15
 */
class AskController{

    private $_db;

    public function __construct($db){
        $this->_db= $db;

    }
    public function html_spe($unsecure){
        return htmlspecialchars($unsecure);
    }
    public function run(){
        if (empty($_SESSION['member'])) {
            header("Location: index.php?action=home");
            die();
        }

        $notif="";
        $category_array=$this->_db->select_category();
        if(empty($_POST)){
            $notif = "";
        }
        elseif(empty($_POST['title']) or empty($_POST['subject'])){
            $notif= "Please complete all fields";

        }
        elseif($this->_db->create_question($this->html_spe($_POST['title']),$this->html_spe($_POST['category']), $this->html_spe($_POST['subject']))){
            header("Location: index.php?action=home");
            die();
        }
        else{
            $notif = "An error is occured";
        }
        require_once(VIEWS_WAY.'ask.php');
    }
}
