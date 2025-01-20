<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once './controllers/UserController.php';
require_once './controllers/FormationController.php';

// Basic routing example
$page = $_GET['page'] ?? 'login'; // Default to 'login'

switch ($page) {
    case 'login':
        $controller = new UserController();
        $controller->showLogin();
        break;
    case 'register':
        $controller = new UserController();
        $controller->showRegister();
        break;
    case 'formation':
        $controller = new FormationController();
        $controller->showFormation();  // Toon formatiepagina
        break;
    default:
        echo "404 Page Not Found";
        break;
}
?>
