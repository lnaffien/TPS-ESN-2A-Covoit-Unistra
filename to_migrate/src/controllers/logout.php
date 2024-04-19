<?php
    class Logout_Ctrl
    {
        public function execute()
        {
            // Supprimer toutes les variables de session
            session_unset();

            // Détruire la session
            session_destroy();

            require('views/login.php');
        }
    }
?>
