<?php
/**
 * Created by PhpStorm.
 * User: killa
 * Date: 21/04/2019
 * Time: 23:10
 */
class ProfileController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        if (empty($_SESSION['member'])) {
            header("Location: index.php?action=home");
            die();
        }
        $question_array=$this->_db->select_question_member($_SESSION['member']->getIdMember());
        require_once(VIEWS_WAY . 'profile.php');
    }
}