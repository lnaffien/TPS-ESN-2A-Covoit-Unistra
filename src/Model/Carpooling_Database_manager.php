<?php

require_once('src/Model/Database_manager.php');
require_once('src/Model/User.php');


class Carpooling_Database_manager
{
    public static function add_carpooling_history($data)
    {
        if (!isset($data['dateCovoiturage'], $data['idUser'], $data['idUserAmi'], $data['status'], $data['aller'], $data['retour'])) {
            return false; // Missing data
        }
        return Database_manager::add_data('historique', $data);
    }
}
?>