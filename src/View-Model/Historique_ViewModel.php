<?php
class Historique_ViewModel
{
    public static function execute()
    {   
        require_once('src/Model/User.php');
        
        // Load html view
       // include('src/View/header_connected.php');
        require_once('src/View/historique_page.php');
    }
}

?>