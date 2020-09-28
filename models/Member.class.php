<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 09:48
 */
class Member{
    private $_id_member;
    private $_name;
    private $_last_name;
    private $_email;
    private $_password;
    private $_activated;
    private $_admin;

    public function __construct($id_member, $name, $last_name, $email, $password, $admin, $activated){
        $this->_id_member=$id_member;
        $this->_name=$name;
        $this->_last_name=$last_name;
        $this->_email=$email;
        $this->_password=$password;
        $this->_admin=$admin;
        $this->_activated=$activated;

    }


    public function getIdMember()
    {
        return $this->_id_member;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getLastName()
    {
        return $this->_last_name;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getActivated()
    {
        return $this->_activated;
    }

    public function getAdmin()
    {
        return $this->_admin;
    }
}
?>