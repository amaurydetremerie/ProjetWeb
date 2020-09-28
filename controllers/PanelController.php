<?php
/**
 * Created by PhpStorm.
 * User: killa
 * Date: 21/04/2019
 * Time: 23:11
 */
class PanelController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }
    public function html_spe($unsecure){
        $secure = htmlspecialchars($unsecure);
        return $secure;
    }
    public function run()
    {

        if (empty($_SESSION['member']) || $_SESSION['member']->getAdmin() == 0) {
            header("Location: index.php?action=home");
            die();
        }

        if(isset($_GET['activated'])){
            $this->_db->activate_user($this->html_spe($_GET['activated']));
        }
        if(isset($_GET['inactivated'])){
            $this->_db->inactivate_user($this->html_spe($_GET['inactivated']));
        }
        if(isset($_GET['admin'])){
            $this->_db->set_admin($this->html_spe($_GET['admin']));
        }
        $user_array = $this->_db->select_all_user();
        $session=$_SESSION['member'];
        require_once (VIEWS_WAY.'panel.php');
    }
}