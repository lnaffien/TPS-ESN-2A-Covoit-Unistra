<?php

// TODO : Vérifier le format des informations côté client
/*
 * js = client, php = serveur
 */

if(isset($_POST['action_login_submit']))
{
    if(Login_ViewModel::check_login())
    {
        print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                    <input type='hidden' name='action' value='homepage'>
                </form>
                <script type='text/javascript'>
                    document.back_to_index_form.submit();
                </script>
            ");
    }
}

// TODO
class Login_ViewModel
{
    // TODO
    public static function execute()
    {
        require_once('src/View/login_page.php');
    }

    public static function check_login()
    {

        // Get data from the form
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT);

        // Check mail format
       /* if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error'] = 'Mail : Incorrect format.';
            return false;
        }*/

        // Fetch user data
        require_once('src/Model/User_Database_manager.php');
        $user_data = User_Database_manager::get_users_from_email($email);

        // Check if the given email is associated to an existing user
        if($user_data->rowcount() == 0)
        {
            $_SESSION['error'] = 'Unknown user, please register.';
            return false;
        }
        
        // Transforms SQL result into an array
        $user_row_data = $user_data->fetch(\PDO::FETCH_ASSOC);

        // Check if the password is correct
        if(!password_verify($password, $user_row_data['motDePasse']))
        {
            $_SESSION['error'] = 'Incorrect email or password.';
            return false;
        }

        // Load user infromations
        require_once('src/Model/User.php');
        $user = Login_ViewModel::create_user($user_row_data);

        // Load user friends
        $friends = Login_ViewModel::load_friend($user);
        $user->__set('friends', $friends);
        
        // Store logged user info into cookies
        $_SESSION['user'] = $user;

        return true;

       // unset($_SESSION['user']);
    }

    private static function create_user($new_user_properties)
    {
        return new User( $new_user_properties['idUser'],
                            $new_user_properties['nom'],
                            $new_user_properties['prenom'], 
                            $new_user_properties['email'],
                            $new_user_properties['telephone'],
                            $new_user_properties['nagenda'],
                            null);
    }

    private static function load_friend($user)
    {
        // Load user friends
        $user_friends = array();
        $friends_query = User_Database_manager::get_friend($user);
         
        // Parse result into an array
        $friends_row_data = $friends_query->fetchAll(\PDO::FETCH_ASSOC);

        foreach($friends_row_data as $friend_line)
        {         
            // Get friend data
            $friend_data = User_Database_manager::get_user_from_id($friend_line['idUtilisateurAmi']);
            $friend_row_data = $friend_data->fetch(\PDO::FETCH_ASSOC);

            // Add friend data to a friends list
            $user_friends[] = Login_ViewModel::create_user($friend_row_data);
        }

        return $user_friends;
    }

}

/*
                    // TODO Vérification si la variable $_SESSION['error'] est définie
                    if(isset($_SESSION['error'])) {
                        echo '<p class="error">' . $_SESSION['error'] . '</p>';
                        unset($_SESSION['error']); // Suppression de la variable $_SESSION['error']
                    }*/
?>
