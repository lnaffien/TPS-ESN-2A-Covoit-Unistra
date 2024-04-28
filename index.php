<?php

// Get errors
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

require_once('src/Model/User.php');
session_start();

// On charge les contrôleurs et les modèles
require_once('src/View-Model/Login_ViewModel.php');
require_once('src/View-Model/Register_ViewModel.php');
require_once('src/View-Model/Home_ViewModel.php');
require_once('src/View-Model/Edit_User_ViewModel.php');
require_once('src/View-Model/Friends_ViewModel.php');
require_once('src/View-Model/Notifications_ViewModel.php');
require_once('src/View-Model/Settings_ViewModel.php');
require_once('src/View-Model/Historique_ViewModel.php');
require_once('src/View-Model/Demande_ViewModel.php');

try {
    if (isset($_POST['action'])){
        switch ($_POST['action']) {
            // Login page
            case 'login':
                Login_ViewModel::execute();
                break;
            // Register page
            case 'register':
                Register_ViewModel::execute();
                break;
            // Home page
            case 'homepage':
                Home_ViewModel::execute();
                break;
            // Friends page
            case 'friend' :
                Friend_ViewModel::execute();
                break;
            // Notifications page
            case 'notification':
                Notifications_ViewModel::execute();
                break;
            // Settings page
           case 'settings':
                Settings_ViewModel::execute();
                break;
            // Edit user data page
            case 'edit':
                Edit_User_ViewModel::execute();
                break;
            // Historique page
            case 'historique':
                Historique_ViewModel::execute();
                break;
            case 'request':
                $friendId = $_POST['friend_id'];
                $friendName = $_POST['friend_name'];
                $friendEmail = $_POST['friend_email'];
                $friendDate = $_POST['friend_date'];
                $friendTel = $_POST['friend_tel'];
                Demande_ViewModel::execute($friendId, $friendName,$friendEmail,$friendDate,$friendTel);
                break;

            default:
                // Page d'erreur 404
                http_response_code(404);
                echo "Page introuvable 404";
                break;
        }
    }
    else
    {
        // Page d'accueil
        //Test_ViewModel::execute();
        Login_ViewModel::execute();
        //(new Login_Ctrl())->execute();
    }
} catch (Exception $e) {
    echo $e;
}
?>
