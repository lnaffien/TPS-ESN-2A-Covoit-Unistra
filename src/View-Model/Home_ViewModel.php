<?php

if(isset($_POST['home_page_click']))
{
    $next_page_instruction = 'homepage';

    switch($_POST['home_page_click'])
    {
        case 'reload_calendar_data' :
            $next_page_instruction = 'homepage';
            break;

    }
    print("<form id='form' name='action_next_page' action='../../index.php' method='POST'>
                <input type='hidden' name='action' value='$next_page_instruction'>
            </form>
            <script type='text/javascript'>
                document.action_next_page.submit();
            </script>
        ");

}


class Home_ViewModel
{
    public static function execute()
    {   
        require_once('src/Model/User.php');
        require_once('src/Model/Agenda_manager.php');

       // include('src/View/header_connected.php');

        // Load agenda for 7 days starting from the current date
        // TODO : Timezone
        $currentDate = (new \DateTime((string)date('Y-m-d H:i:s')))->setTimezone(new \DateTimeZone('Europe/Paris'));
        $_SESSION['dateSelected']['start'] = $currentDate;
        $_SESSION['dateSelected']['end'] = (clone $currentDate)->modify("7 days");

        $interval = DateInterval::createFromDateString('1 day');
        $_SESSION['dateSelected']['period'] = new DatePeriod($currentDate, $interval, $_SESSION['dateSelected']['end']);      


        $calendarFull = Agenda_manager::get_full_agenda($_SESSION['user']->__get('nagenda'));
        $calendarWeek = Agenda_manager::filter_date($calendarFull, $currentDate, 7);
        
        foreach($calendarWeek as $day)
        {
            $_SESSION[$day->__get('date')]['start_time'] = $day->__get('start_time')->format('H:i:s');
            $_SESSION[$day->__get('date')]['end_time'] = $day->__get('end_time')->format('H:i:s');

           /* print_r('Date : ' . $day->__get('date')/*->format('Y-m-d')*/ /*. "<br/>");
            print_r('Heure de début : ' . $_SESSION[$day->__get('date')]['start_time'] . "<br/>");
            print_r('Heure de fin : ' . $_SESSION[$day->__get('date')]['end_time'] . "<br/>");

            print_r("<br/>");*/
        }


        require_once('src/View/home_page.php');
    }
}
/*
 // Vérification si la variable $_SESSION['error'] est définie
 if(isset($_SESSION['error'])) {
    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']); // Suppression de la variable $_SESSION['error']
}
*/
?>
