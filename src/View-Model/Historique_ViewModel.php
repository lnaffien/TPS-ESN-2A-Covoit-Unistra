<?php
class Historique_ViewModel
{
    public static function execute()
    {   
        $acceptedRequests = self::getAcceptedRequests($_SESSION['user']->__get('id'));
        require_once('src/View/historique_page.php');
    }

    public static function getAcceptedRequests($userId)
    {
        require_once('src/Model/Carpooling_Database_manager.php');
        return Carpooling_Database_Manager::get_accepted_requests($userId);
    }
}

?>