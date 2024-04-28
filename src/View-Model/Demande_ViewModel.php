<?php

if(isset($_POST['action_request_covoit']))
{
   if(Demande_ViewModel::check_request_data())
    {
        // rediriger vers login page
        header('Location: index.php?action=historique');
        exit;
    }
    else
    {
        // rediriger vers register page
           header('Location: index.php?action=homepage');
           exit;
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
        
        $carpooling_data = array(
            'dateCovoiturage' => '2024-04-28',
            'idUser' => 10, 
            'idUserAmi' => 11, 
            'status' => 'awaiting',
            'aller' => 1,
            'retour' => 0,
        );
        $result = Carpooling_Database_Manager::add_carpooling_history($carpooling_data);
        
        if ($result) {
            echo "Carpooling history added successfully.";
        } else {
            echo "Failed to add carpooling history.";
        }
        
    }





}

?>
