<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_request_covoit']))
{
    // Check if the "Envoyer une demande" button was clicked
    if (isset($_POST['action_request_covoit']))
    {
        echo "<script>console.log('Bonjour!')</script>";
        if(Demande_ViewModel::check_request_data())
        {
            print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                        <input type='hidden' name='action' value='homepage'>
                    </form>
                    <script type='text/javascript'>
                        document.back_to_index_form.submit();
                    </script>
                ");
        }
        else
        {
            print("<form id='form' name='back_to_index_form' action='index.php' method='POST'>
                        <input type='hidden' name='action' value='request'>
                    </form>
                    <script type='text/javascript'>
                        document.back_to_index_form.submit();
                    </script>
                ");
        }
    }
}

class Demande_ViewModel
{

    public static function execute($friendId, $friendName,$friendEmail, $friendDate,$friendTel)
    {
        require_once('src/View/demande_popup.php');
        require_once('src/Model/User.php');
        require_once('src/Model/Agenda_manager.php');
    }

    public static function check_request_data()
    {
        require_once('src/Model/Carpooling_Database_Manager.php');

        $friendId = isset($_POST['friend_id']) ? $_POST['friend_id'] : null; 
        $friendDate = isset($_POST['friend_date']) ? $_POST['friend_date'] : null; 

        $carpooling_data = array(
            'dateCovoiturage' => $friendDate,
            'idUser' => $_SESSION['user']->__get('id'), 
            'idUserAmi' => $friendId, 
            'status' => 'awaiting',
            'aller' => isset($_POST['aller_retour']) ? 1 : 0,
            'retour' => isset($_POST['retour']) ? 1 : 0,
        );
        $result = Carpooling_Database_Manager::add_carpooling_history($carpooling_data);
        
        if ($result) {
            echo "Carpooling history added successfully.";
            return true;
        } else {
            echo "Failed to add carpooling history.";
        }
    }
        
    }






?>
