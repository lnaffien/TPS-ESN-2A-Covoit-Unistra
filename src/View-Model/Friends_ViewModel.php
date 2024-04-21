<?php
require_once("src/Model/User_Database_manager.php");
require_once("src/Model/User.php");

if(isset($_POST['friend_page_click']))
{
    $next_page_instruction = 'friend';

    switch($_POST['friend_page_click'])
    {
        // User research
        case 'search_user' :
            // Extract first and last name from the input
            $name_searched = filter_input(INPUT_POST, 'search');
            $name_searched = preg_replace('/\s+/', ' ', $name_searched);          

            $name_searched_arrray = explode(" ", $name_searched);
            $first_name = $name_searched_arrray[0];
            $last_name = $name_searched_arrray[0];
            if(isset($name_searched_arrray[1]))
            {
                $last_name = $name_searched_arrray[1];
            }
            // Get database results as an array
            $_SESSION['search_users'] = (User_Database_manager::get_users_from_name($first_name, $last_name))->fetchAll(\PDO::FETCH_ASSOC);
            break;

        // Add user as friend
        case 'add_friend' :
            // Get the new friend data
            $new_friend_data = User_Database_manager::get_user_from_id($_POST['friend_id'])->fetch(\PDO::FETCH_ASSOC);
            $new_friend = new User(
                                    $new_friend_data['idUser'],
                                    $new_friend_data['nom'],
                                    $new_friend_data['prenom'], 
                                    $new_friend_data['email'],
                                    $new_friend_data['telephone'],
                                    $new_friend_data['nagenda'],
                                    null
                                );
            // Add the new friend
            User_Database_manager::add_friend($_SESSION['user'], $new_friend);
            break;
        
        // Remove user as friend
        case 'remove_friend' :
            $old_friend = $_SESSION['user']->get_friend_by_id($_POST['friend_id']);
            User_Database_manager::remove_friend($_SESSION['user'], $old_friend);
            break;

        // The button to display the friends removal has been clicked
        case 'remove_friend_btn' :
            $_SESSION['remove_friend_btn'] ? $_SESSION['remove_friend_btn'] = false : $_SESSION['remove_friend_btn'] = true;
            break;

    }
    print("<form id='form' name='action_next_page' action='index.php' method='POST'>
                <input type='hidden' name='action' value='$next_page_instruction'>
            </form>
            <script type='text/javascript'>
                document.action_next_page.submit();
            </script>
        ");

}


class Friend_ViewModel
{
    public static function execute()
    {
        if(!isset( $_SESSION['remove_friend_btn']))
        {
            $_SESSION['remove_friend_btn'] = false;
        }
        require_once('src/View/friends_page.php');
    }
}

?>