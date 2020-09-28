<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 04-04-19
 * Time: 09:21
 */
class HomeController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;

    }
    public function html_spe($unsecure){
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }
    public function run(){

        if(empty($_GET['search'])){
            $question_array=$this->_db->select_questions();
        }
        else{
            $question_array=$this->_db->select_questions($this->html_spe($_GET['search']));
        }
         require_once (VIEWS_WAY.'home.php');

    }


}