<?php

use Application\Libs\Database\DatabaseConnection;
use Application\Models\Profil\Profil;

require_once('src/models/profil.php');

class Profil_Ctrl
{
    public function execute()
    {
        // Afficher la page du profil
        require('views/profil.php');
    }

}
?>

