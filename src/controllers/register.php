<?php
use Application\Libs\Database\DatabaseConnection;
use Application\Models\Register\Register;

require_once('src/models/register.php');

class Register_Ctrl
{
    public function execute()
    {
        require('views/register.php');
    }

    public function newUser(){
        $database = new DatabaseConnection();
        (new Register($database))->newUser();
        require('views/login.php');
    }
}
?>
