<?php

// TODO
class Test_ViewModel
{
    // TODO
    public function execute()
    {
        /*include('src/View/header_anonymous.php');
        require('src/View/test_page.php'); */
                
        require_once('src/Model/User_Database_manager.php');
        require_once('src/Model/User.php');
        require_once('src/Model/Agenda_manager.php');

        $user = new User(4, "NAFFIEN_etu", "Lucie_etu", "lucie.naffien@etu.unistra.fr", null, 18581, null);
        $user2 = new User(12, "NAFFIEN_etu", "Lucie_etu", "lucie.naffien@etu.unistra.fr", null, 18581, null); 


         // Load user friends
         $friends_query = User_Database_manager::get_friend($user2);
         print_r($friends_query->rowcount());

         $friend_row_data = $friends_query->fetch(\PDO::FETCH_ASSOC);
         print_r($friend_row_data['idUtilisateur']);

         $friend_data = User_Database_manager::get_user_from_id($friend_row_data['idUtilisateurAmi']);
         print_r($friend_data);

         foreach($friend_row_data as $friend)
         {
            $friend_data = User_Database_manager::get_user_from_id($friend['idUtilisateurAmi']);
            print_r($friend_data);

         }
         
         /*

         $friends = array();
         foreach($friends_query as $friend)
         {
             $friend_data = User_Database_manager::get_user_from_id($friend['idUtilisateurAmi']);
             $friend_row_data = $friend_data->fetch(\PDO::FETCH_ASSOC);

             print_r($friend_data['nom']);             
             print_r("hey<br/>");

             
             print_r("<br/>");
 
            /* $friends[] = new User($friend_data['idUser'],
                                     $friend_data['nom'],
                                     $friend_data['prenom'], 
                                     $friend_data['email'],
                                     $friend_data['telephone'],
                                     $friend_data['nagenda'],
                                     null);
         }*/
 

       /* $properties = array('nom' => "INSERER", 
                             'prenom' => 'donnees',
                             'email' => 'inserer@donnees.com',
                             'motDePasse' => 'hopla',
                             'nagenda' => 65412,
                             'dateInscription' => ((new \DateTime((string)date('Y-m-d')))->setTimezone(new \DateTimeZone('Europe/Paris')))->format('Y-m-d') );
*/
        //User_Database_manager::remove_friend($user, $user2);

        /*$user_id = $user->__get("idUser");
        $query_result = Database_manager::get_data('UTILISATEUR', '*', "WHERE idUser=$user_id");
        foreach ($query_result as $row) {
            foreach($row as $data)
            {
                print_r($data);
                print_r("<br/>");
            }
            
            print_r("<br/><br/>");
        }


        Database_manager::update_user($user, 'nom');*/

       /* $agenda = Agenda_manager::get_full_agenda($user->__get("nagenda"));
        $start_date = (new \DateTime((string)date('Y-m-d H:i:s')))->setTimezone(new \DateTimeZone('Europe/Paris'));
        Agenda_manager::filter_date($agenda, $start_date, 7);*/

    }

}
?>
