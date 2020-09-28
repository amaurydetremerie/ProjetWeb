<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 10:20
 */
class Answer{
    private $_id_answer;
    private $_subject;
    private $_date;
    private $_user;
    private $_nbVotesPos;
    private $_nbVotesNeg;

    public function __construct($id_answer,$subject,$date,$user,$nbVotesPos,$nbVotesNeg){
        $this->_id_answer=$id_answer;
        $this->_user=$user;
        $this->_subject=$subject;
        $this->_date=$date;
        $this->_nbVotesPos=$nbVotesPos;
        $this->_nbVotesNeg=$nbVotesNeg;
    }

    public function getIdAnswer()
    {
        return $this->_id_answer;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function getDate()
    {
        return $this->_date;
    }
    public function getNbVotesPos(){
        return $this->_nbVotesPos;

    }
    public function getNbVotesNeg(){
        return $this->_nbVotesNeg;

    }
}
?>