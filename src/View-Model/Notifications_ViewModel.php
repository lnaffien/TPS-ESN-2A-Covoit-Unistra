<?php
class Notifications_ViewModel
{
    public static function execute()
    {
        // Handle form submissions
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_accept_covoit'])) {
               // self::acceptRequest($_POST['request_id1']);
                self::acceptRequest($_POST['request_id1']);  
        }
        $awaitingRequests = self::getAwaitingRequests($_SESSION['user']->__get('id'));
        require_once('src/View/notifications_page.php');
    }

    public static function getAwaitingRequests($userId)
    {
        require_once('src/Model/Carpooling_Database_manager.php');
        return Carpooling_Database_Manager::get_awaiting_requests($userId);
    }

    public static function acceptRequest($requestId)
    {
        return Carpooling_Database_manager::update_request_status($requestId, 'accepted');
    }

    public static function rejectRequest($requestId)
    {
        return Carpooling_Database_manager::update_request_status($requestId, 'denied');
    }

}
?>