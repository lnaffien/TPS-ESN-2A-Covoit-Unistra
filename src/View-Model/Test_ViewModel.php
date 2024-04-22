<?php

// TODO
class Test_ViewModel
{
    // TODO
    public static function execute()
    {
        /*include('src/View/header_anonymous.php');
        require('src/View/test_page.php'); */
                
        require_once('src/Model/User_Database_manager.php');
        require_once('src/Model/User.php');
        require_once('src/Model/Agenda_manager.php');

        $user = new User(4, "NAFFIEN_etu", "Lucie_etu", "lucie.naffien@etu.unistra.fr", null, 18581, null);
        $user2 = new User(12, "NAFFIEN_etu", "Lucie_etu", "lucie.naffien@etu.unistra.fr", null, 18581, null);  
        
        /* Illkirch : A, B ou C, puis 3 chiffes OU Cafétéria 
         * HAG : 
         */ 
        $raw_calendar = Agenda_manager::get_full_agenda(18581);
        //print_r($raw_calendar);

        foreach($raw_calendar as $event)
        {
            /*
             * LOCATION : salle
             * SUMMARY : intitulé
            */
            print($event->compare_start_place($event) ? "similaires" : "différents");
            //$array = ((string)$event->LOCATION);
           /* print_r($event->__get('date'));
            print_r(" : ");
            print_r($event->__get('start_place'));
            print_r("    |    ");
            print_r($event->__get('end_place'));*/
           // $array = $event->serialize();
            //print_r($array);
            //print_r((string)$event->SEQUENCE);//
                print_r("<br/>");
               // break;
            
        }
    }

}
?>
