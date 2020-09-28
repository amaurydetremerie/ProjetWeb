<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 25-04-19
 * Time: 22:00
 */
class EditController
{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function html_spe($unsecure)
    {
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }

    public function run()
    {
        if (empty($_SESSION['member'])) {
            header("Location: index.php?action=home");
            die();
        }
        $notif = '';
        $category_array = $this->_db->select_category();
        $id=$_GET['id'];
        $question = $this->_db->question_id($this->html_spe($_GET['id']));
        if (empty($_POST)) {
            $notif = '';
        } elseif (empty($_POST['title']) or empty($_POST['category'] or empty($_POST['subject']))) {
            $notif = 'Please fill all the filed';
        } elseif ($this->_db->edit_question($this->html_spe($_POST['title']), $this->html_spe($_POST['category']), $this->html_spe($_POST['subject']), $question->getIdQuestion())) {
            header("Location:index.php?action=question&id=$id");
            die();
        } else {
            $notif = 'an error has occurs';
        }
        require_once(VIEWS_WAY . 'edit.php');

    }
}