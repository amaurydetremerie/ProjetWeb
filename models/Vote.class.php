<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 09:48
 */
class Vote{
    private $_value;

    public function __construct($value){
        $this->_value=$value;
    }

    public function getValue()
    {
        return $this->_value;
    }
}
?>