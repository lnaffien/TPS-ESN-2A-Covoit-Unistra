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
require_once('src/View-Model/Test_ViewModel.php');

require_once('src/View-Model/Login_ViewModel.php');
require_once('src/View-Model/Register_ViewModel.php');
require_once('src/View-Model/Home_ViewModel.php');
/*
require_once('src/controllers/logout.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/register.php');
require_once('src/controllers/profil.php');
require_once('src/controllers/modifProfil.php');
require_once('src/controllers/admin.php');*/

try {
    if (isset($_POST['action'])){
        switch ($_POST['action']) {
            // Test page
            case 'test':
                (new Test_ViewModel())->execute();
                break;
            // Login page
            case 'login':
                Login_ViewModel::execute();
                break;
            // Register page
            case 'register':
                (new Register_ViewModel())->execute();
                break;
            case 'homepage': // Homepage
                Home_ViewModel::execute();
                break;
           /* case 'homepage_filters': // Homepage - Rafraîchissement Homepage avec filtres
                (new Homepage_Ctrl())->valideFilters($_POST['date'], $_POST['BarreR']);
                break;
            case 'logout': // Déconnexion
                (new Logout_Ctrl())->execute();
                break;

            case 'register_new': // Création d'un nouveau compte
                (new Register_Ctrl())->newUser();
                break;
            case 'profil': // Page profil
                (new Profil_Ctrl())->execute();
                break;
            case 'modifier_profil': // Modification de la page profil
                (new modifierProfil_ctrl())->execute();
                break;
            case 'admin': // Page admin 
                (new Admin_ctrl())->execute();
                break;
            case 'delete_users': // Suppression d'un utilisateur
                (new Admin_ctrl())->delete_users();
                break;
                */
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
        //(new Test_ViewModel())->execute();
        Login_ViewModel::execute();
        //(new Login_Ctrl())->execute();
    }
} catch (Exception $e) {
    echo $e;
}
?>
