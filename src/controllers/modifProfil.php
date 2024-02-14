<?php
use Application\Libs\Database\DatabaseConnection;
use Application\Models\Profil\Profil;

require_once('src/models/profil.php');

class modifierProfil_ctrl
{
    public function execute()
    {
        $database = new DatabaseConnection();
        $profil = new Profil($database);
        $profil->modif_profil();
        require('views/profil.php');
    }
}
?>