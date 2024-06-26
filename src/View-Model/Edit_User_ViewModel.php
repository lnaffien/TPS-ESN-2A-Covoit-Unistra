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

class Edit_User_ViewModel
{
    // TODO
    public static function execute()
    {
        require_once('src/View/edit_user_page.php');
        //Edit_User_ViewModel::check_update();
    }

    public static function check_update()
    {        
        require_once('src/Model/User_database_manager.php');

        // Get data from the form
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
        $nagenda = filter_input(INPUT_POST, 'nagenda', FILTER_SANITIZE_NUMBER_INT);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT);
        $confirm_mdp = filter_input(INPUT_POST, 'confirm_mdp', FILTER_DEFAULT);

        // TODO : password updates

       /* if (empty($nom) || empty($prenom) || empty($email) || empty($nagenda) || empty($mdp) || empty($confirm_mdp)) 
        {
            $_SESSION['error'] = "Please make sure to complete all the fields with an *.\n";
            echo $_SESSION['error'];
            return false;
        } */

        // Check if the given email is already associated to another user
        if($email != $_SESSION['user']->__get('email'))
        {
            $user_data = Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$email\"");  

            if($user_data->rowcount() != 0)
            {
                $_SESSION['error'] = 'Mail not available';
                echo $_SESSION['error'];
                return false;
            }
        }

        // Updates password if needed
        if($mdp != null && $confirm_mdp != null)
        {   
            // Check if the passwords match
            if($mdp != $confirm_mdp)
            {
                $_SESSION['error'] = "Passwords don't match.";
                return false;
            }
            else
            {
                User_Database_manager::update_user_password($_SESSION['user'], $mdp);
            }
        }
        
        // Update user
        $temp_user = clone $_SESSION['user'];
        if(User_Database_manager::update_user($temp_user))
        {        
            $_SESSION['user']->__set_all_personal_data($nom, $prenom, $email, $telephone, $nagenda);
            return true;
        }

        return false;//Database_manager::update_user_all($_SESSION['user']);
    }
}

?>