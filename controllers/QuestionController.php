<?php
/**
 * Created by PhpStorm.
 * User: killa
 * Date: 21/04/2019
 * Time: 23:10
 */
class QuestionController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }
    public function html_spe($unsecure){
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }
    public function run()
    {
        $class='';
        $state='';
        $question = $this->_db->question_id($this->html_spe($_GET['id']));
        $notification = '';
       if (!isset($_GET['id'])) {
            header("Location: index.php?action=home");
            die();
        }
        else{
            if(!empty($_GET['state'])){
                if($_GET['state'] == 'D' || $_GET['state'] == 'S' || $_GET['state'] == 'O'){
                    if($question->getState() != 'D'){
                        $this->_db->state($this->html_spe($_GET['id']), $this->html_spe($_GET['state']));
                        if($_GET['state'] == 'O'){
                            $this->_db->delete_right_answer($_GET['id']);
                        }
                    }
                    else{
                        if($_SESSION['member']->getAdmin() == 1){
                            $this->_db->state($this->html_spe($_GET['id']), $this->html_spe($_GET['state']));
                        }
                        else{
                            $notification='This question is marked as duplicate';
                        }
                    }
                }
                else{
                    unset($_GET['state']);
                }
            }
            if(!empty($_GET['delete'])){
                if(!$this->_db->delete_question($this->html_spe($_GET['id']))){
                    echo 'an error is occured';
                }
                else{
                    header("Location: index.php?action=home");
                    die();
                }
            }
            if(!empty($_POST['reply'])){
                if (!empty($_SESSION['member'])){
                    if($question->getState() != 'D'){
                        $this->_db->create_answer($this->html_spe($_POST['reply']),$this->html_spe($_GET['id']));

                    }
                    else{
                        $notification='This question is marked as duplicate';
                    }
                }
                else{
                $notification = 'Login first to perform this action';
                }
            }
            if(isset($_GET['rightAnswer'])) {
                if (!empty($_SESSION['member'])){
                    if($question->getState() != 'D'){
                        $this->_db->choose_right_answer($this->html_spe($_GET['id']),$this->html_spe($_GET['rightAnswer']));
                        $this->_db->state($this->html_spe($_GET['id']),'S');
                    }
                    else{
                        $notification='This question is marked as duplicate';
                    }
                }
                else{
                    $notification = 'Login first to perform this action';
                }

            }
            if(isset($_GET['id_answer'])){
                if (!empty($_SESSION['member'])) {
                    if ($question->getState() != 'D') {
                        $vote = $this->_db->select_vote($this->html_spe($_GET['id_answer']),$_SESSION['member']->getIdMember())->getValue();
                        var_dump($vote);
                        if($_GET['vote']=='Pos'){
                            if($vote != null && $vote == 'P'){
                                $notification = 'You have already vote positively for this answer';
                            }
                            else{
                                $this->_db->vote_Pos($this->html_spe($_GET['id_answer']),$_SESSION['member']->getIdMember());
                                $notification='Your voted is saved !';
                            }
                        }
                        elseif($_GET['vote']=='Neg') {
                            if ($vote != null && $vote == 'N') {
                                $notification = 'You have already vote negatively for this answer';
                            } else {
                                $this->_db->vote_Neg($this->html_spe($_GET['id_answer']), $_SESSION['member']->getIdMember());
                                $notification='Your voted is saved !';
                            }
                        }
                    }
                    else{
                        $notification='This question is marked as duplicate';
                    }
                }
                else {
                    $notification = 'Login first to perform this action';
                }
            }
        }
        $question = $this->_db->question_id($this->html_spe($_GET['id']));
        $answer_array = $this->_db->select_answers($this->html_spe($_GET['id']));
        if(!empty($_SESSION['member'])) {
            $session = $_SESSION['member'];
        }

        if($question->getState() == 'S'){
            $class='table-success';
            $state='Solved';
        }
        if($question->getState() == 'D'){
            $class='table-danger';
            $state='Duplicate';
        }
        if($question->getState() == 'O'){
            $class='table-light';
            $state='Open';
        }
        require_once(VIEWS_WAY . 'question.php');

    }
}