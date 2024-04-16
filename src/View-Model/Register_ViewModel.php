<?php

if(isset($_POST['action_register_submit']))
{
    if(Register_ViewModel::check_register_data())
    {
        print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                    <input type='hidden' name='action' value='login'>
                </form>
                <script type='text/javascript'>
                    document.back_to_index_form.submit();
                </script>
            ");
    }
    else
    {
        print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                    <input type='hidden' name='action' value='register'>
                </form>
                <script type='text/javascript'>
                    document.back_to_index_form.submit();
                </script>
");
// TODO : https://www.phptutorial.net/php-tutorial/php-registration-form/ pour avoir un truc plus propre
    }
}

// TODO
class Register_ViewModel
{
    // TODO
    public static function execute()
    {
        include('src/View/header_anonymous.html');
        require_once('src/View/register_page.html');
    }

    public static function check_register_data()
    {
        // Get data from the form
        // TODO : utiliser trim() pour supprimer les espaces avant et après ?
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
        $nagenda = filter_input(INPUT_POST, 'nagenda', FILTER_SANITIZE_NUMBER_INT);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT);
        $confirm_mdp = filter_input(INPUT_POST, 'confirm_mdp', FILTER_DEFAULT);

        if (empty($nom) || empty($prenom) || empty($email) || empty($nagenda) || empty($mdp) || empty($confirm_mdp)) 
        {
            $_SESSION['error'] = "Please make sure to complete all the fields with an *.\n";
            echo $_SESSIOn['error'];
            return false;
        } 

        // Check mail format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error'] = 'Mail : Incorrect format.';
            return false;
        }

        // Check if the given email is already associated to an existing user
        require_once('src/Model/Database_manager.php');
        $user_data = Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$email\"");        
        if($user_data->rowcount() != 0)
        {
            $_SESSION['error'] = 'User already exists.';
            return false;
        }

        // TODO : check password format
        // TODO : check telephone format
        // TODO : nagenda format

        // Check if the passwords match
        if($mdp != $confirm_mdp)
        {
            $_SESSION['error'] = "Passwords don't match.";
            return false;
        }
        
        // Add user
        $user = new User(null, $nom, $prenom, $email, $telephone, $nagenda, null);
        return Database_manager::add_user($user, $mdp);
    }
}

/*
    To further secure your login system, you should implement the following best practices:

    - Use HTTPS to encrypt data transmitted between the client and server.
    - Implement CSRF (cross-site request forgery) protection using tokens.
    - Limit the number of failed login attempts to prevent brute-force attacks.
    - Store sensitive information — such as database credentials — in a separate configuration file outside the web server’s document root. 
*/

?>
