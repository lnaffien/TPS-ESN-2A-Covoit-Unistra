<?php

namespace Application\Libs\Database;

class DatabaseConnection
{
    private $host = 'localhost';
    private $port = '3306';
    private $db_name = 'appcovoit';
    private $username = 'root';
    private $password = 'root';

    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->database;
    }
}
