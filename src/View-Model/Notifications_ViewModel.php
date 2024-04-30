<?php
if(isset($_POST['action_update_submit']))
{
    echo "<script>console.log('Hello' );</script>";
    $result = Edit_User_ViewModel::check_update();
    if(Edit_User_ViewModel::check_update())
    {
        print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                    <input type='hidden' name='action' value='settings'>
                </form>
                <script type='text/javascript'>
                    document.back_to_index_form.submit();
                </script>
            ");
    }
    else
    {
        print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                    <input type='hidden' name='action' value='edit'>
                </form>
                <script type='text/javascript'>
                    document.back_to_index_form.submit();
                </script>
            ");
// TODO : https://www.phptutorial.net/php-tutorial/php-registration-form/ pour avoir un truc plus propre
    }
}

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