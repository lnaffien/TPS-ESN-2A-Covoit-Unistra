<?php
use Application\Libs\Database\DatabaseConnection;
use Application\Models\Admin\Admin;

require_once('src/models/admin.php');
require_once('src/controllers/homepage.php');

class Admin_ctrl
{
    public function execute()
    {
        if($_SESSION["idUser"] == 1){
            $database = new DatabaseConnection();
            $admin = new Admin($database);
            $admin->get_users();
            require('views/admin.php');
        }
        else{
            $_SESSION['error'] = "Vous devez être connecté en tant qu'administrateur pour accéder à cette page.";
            (new Homepage_Ctrl())->execute();
        
        }
        
    }

    public function delete_users()
    {
        $database = new DatabaseConnection();
        $admin = new Admin($database);


        $userIds = $_POST['user'];

        if(!empty($userIds)) {
            $admin->delete_users($userIds);
            $_SESSION['error'] = "Les utilisateurs sélectionnés ont été supprimés.";

        } else {
            $_SESSION['error'] = "Veuillez sélectionner au moins un utilisateur à supprimer.";
        }
    
        
        $admin->get_users();
        require('views/admin.php');
    }
}
?>