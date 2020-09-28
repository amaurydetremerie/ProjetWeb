<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 29-03-19
 * Time: 07:52
 */

# Definition of global variable
define('MODELS_WAY','models/');
define('VIEWS_WAY','views/');
define('CONTROLLERS_WAY','controllers/');



#Besoin pour utiliser les fonctions de la classe membre dans la session
require_once (MODELS_WAY.'Member.class.php');

# Activate the session's mecanism
session_start();
if(!empty($_SESSION['member'])){
    $session=$_SESSION['member'];

}

#Automatization loading of the classes
function classLoading($classe){
    require_once ('models/'.$classe.'.class.php');
}
spl_autoload_register('classLoading');

#Db connexion
require_once(MODELS_WAY.'Db.php');
$db=Db::getInstance();
# Header of all HMTL pages
require_once(VIEWS_WAY.'header.php');

# S'il n'y a pas de variable GET 'action' dans l'URL, elle est créée ici à la valeur 'accueil'
if (empty($_GET['action'])) {
    $_GET['action'] = 'index';
}
# Switch case sur l'action demandée par la variable GET 'action' précisée dans l'URL
# index.php?action=...
switch ($_GET['action']) {
    case 'home':
        require_once(CONTROLLERS_WAY.'CategoryController.php');
        $control = new CategoryController($db);

        require_once(CONTROLLERS_WAY.'HomeController.php');
        $controller = new HomeController($db);
        break;
    case 'category':
        require_once(CONTROLLERS_WAY.'CategoryController.php');
        $controller = new CategoryController($db);
        break;
#    case 'search':
#        require_once(CONTROLLERS_WAY.'CategoryController.php');
#        $control = new CategoryController($db);
#        require_once(CONTROLLERS_WAY.'SearchController.php');
#        $controller = new SearchController($db);
#        break;
    case 'signup': # action=contact
        require_once(CONTROLLERS_WAY.'SignupController.php');
        $controller = new SignupController($db);
        break;
    case 'question':
        require_once(CONTROLLERS_WAY.'CategoryController.php');
        $control = new CategoryController($db);

        require_once(CONTROLLERS_WAY.'QuestionController.php');
        $controller = new QuestionController($db);
        break;
    case 'login':
        require_once(CONTROLLERS_WAY.'LoginController.php');
        $controller = new LoginController($db);
        break;
    case 'logout':
        require_once(CONTROLLERS_WAY.'LogoutController.php');
        $controller = new LogoutController($db);
        break;
    case 'profile':
        require_once(CONTROLLERS_WAY.'ProfileController.php');
        $controller = new ProfileController($db);
        break;
    case 'ask':
        require_once(CONTROLLERS_WAY.'AskController.php');
        $controller = new AskController($db);
        break;
    case 'panel':
        require_once(CONTROLLERS_WAY.'PanelController.php');
        $controller = new PanelController($db);
        break;
     case 'edit';
     require_once (CONTROLLERS_WAY.'EditController.php');
     $controller= new EditController($db);
     break;
    default: # Par défaut, le contrôleur de l'accueil est sélectionné
        require_once(CONTROLLERS_WAY.'CategoryController.php');
        $control = new CategoryController($db);

        require_once(CONTROLLERS_WAY.'HomeController.php');
        $controller = new HomeController($db);
        break;
}
# Exécution du contrôleur défini dans le switch précédent
if(!empty($control)){
    $control->run();
}
$controller->run();

# Footer of all HMTL pags
require_once(VIEWS_WAY.'footer.php');
#A afficher pour le .htaccess et .htpasswd
echo realpath('index.php');
?>