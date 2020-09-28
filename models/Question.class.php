<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 09:48
 */

class Question{
    private $_id_question;
    private $_title;
    private $_subject;
    private $_date;
    private $_state;
    private $_right_answer;
    private $_user;

    public function __construct($id_question,$title,$subject,$date,$state,$right_answer,$user){
        $this->_id_question=$id_question;
        $this->_title=$title;
        $this->_subject=$subject;
        $this->_date=$date;
        $this->_state=$state;
        $this->_right_answer=$right_answer;
        $this->_user=$user;
    }

    public function getIdQuestion()
    {
        return $this->_id_question;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function getRightAnswer()
    {
        return $this->_right_answer;
    }
    public function getUser()
    {
        return $this->_user;
    }

}
?>