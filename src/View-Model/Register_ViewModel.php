<?php

if(isset($_POST['action_register_submit']))
{
   if(Register_ViewModel::check_register_data())
    {
        // rediriger vers login page
        header('Location: index.php?action=login');
        exit;
    }
    else
    {
        // rediriger vers register page
           header('Location: index.php?action=register');
           exit;
    }
}

// TODO
class Register_ViewModel
{
    // TODO
    public static function execute()
    {
        require_once('src/View/register_page.php');
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
       /* if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error'] = 'Mail : Incorrect format.';
            return false;
        }*/

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
        require_once("src/Model/User_Database_manager.php");
        $success = User_Database_manager::add_user($user, $mdp);

       if($success) {
            //envoyer email de confirmation
            $to = $email; 
            $subject = 'Confirmation';
            $message = 'Cher ' . $prenom . ',<br><br>Vous etes officiellement enregistrés sur CovoitUnistra! .';
            $headers = "From: covoitunistra@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";      
            mail($to, $subject, $message, $headers);
           return true; 
       } else {
           return false; 
       }
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
