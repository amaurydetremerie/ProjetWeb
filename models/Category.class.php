<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 10:19
 */
class Category{
    private $_id_category;
    private $_name;

    public function __construct($id_category,$name){
        $this->_id_category=$id_category;
        $this->_name=$name;
    }

    public function getIdCategory()
    {
        return $this->_id_category;
    }

    public function getName()
    {
        return $this->_name;
    }

}
?>