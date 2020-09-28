<?php
/**
 * Created by PhpStorm.
 * User: killa
 * Date: 09/04/2019
 * Time: 17:07
 */
class CategoryController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }
    public function html_spe($unsecure){
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }
    public function run(){
        if(empty($_GET['category'])){
            $category_array = $this->_db->select_category();
            require_once(VIEWS_WAY . 'category.php');
        }
        else{
            foreach($_GET['category'] as $no => $action){
                $question_array=$this->_db->select_questions_category($this->html_spe($no));
            }
            require_once (VIEWS_WAY.'home.php');
        }
    }


}