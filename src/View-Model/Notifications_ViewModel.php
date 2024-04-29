<?php
class Notifications_ViewModel
{
    public static function execute()
    {
        require_once('src/View/notifications_page.php');
    }

    public static function getAwaitingRequests($userId)
    {
        require_once('src/Model/Database_manager.php');
        //require_once('src/Model/Carpooling_Database_manager.php');
        //return Carpooling_Database_Manager::get_awaiting_requests($userId);
        // Fetch awaiting requests for the current user
        $filter = "WHERE idUserAmi = $userId AND status = 'awaiting'";
        $requests = Database_manager::get_data('historique', '*', $filter);

        // Pass the fetched requests to the view
        require_once('src/View/notifications_page.php');
    }


}
?>