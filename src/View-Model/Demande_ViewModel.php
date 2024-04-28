<?php


class Demande_ViewModel
{
    public static function execute($friendId, $friendName,$friendEmail, $friendDate,$friendTel)
    {
        require_once('src/View/demande_popup.php');
        require_once('src/Model/User.php');
        require_once('src/Model/Agenda_manager.php');
    }

}

?>
