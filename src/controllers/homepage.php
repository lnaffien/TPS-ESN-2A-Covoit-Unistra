<?php
use Application\Libs\Database\DatabaseConnection;
use Application\Models\Homepage\Homepage;
use Application\Models\Homepage\Agendas;

require_once('src/models/homepage.php');

class Homepage_Ctrl
{
    public function execute_first()
    {
        $database = new DatabaseConnection();
        $homepage = new Homepage($database);
        $state = ($homepage->stockDatas());
        if($state == true) { 
            $agendas = new Agendas($database);
            $datasAgendas = $agendas->getAgendas7Days();
            $week = $agendas->getWeek();
            require_once('views/homepage.php');
        }
        if($state == false){
            require_once('views/login.php');
        }
    }

    public function execute(){
        $database = new DatabaseConnection();

        $agendas = new Agendas($database);
        $datasAgendas = $agendas->getAgendas7Days();
        $week = $agendas->getWeek();
        require_once('views/homepage.php');
    }

    public function valideFilters($date, $search){
        $database = new DatabaseConnection();

        $agendas = new Agendas($database);
        $agendas->useFilters($date, $search);
        $datasAgendas = $agendas->getAgendas7Days();
        $week = $agendas->getWeek();
        require_once('views/homepage.php'); 
    }
}
?>
