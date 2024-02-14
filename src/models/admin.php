<?php

namespace Application\Models\Admin;
use Application\Libs\Database\DatabaseConnection;
require_once('src/libs/database.php');


class Admin{
    
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }

    public function get_users(){
        $query = "SELECT * FROM utilisateur";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        $_SESSION['admin'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $_SESSION['admin'];
    }

    public function delete_users($userIds){
        $query = "DELETE FROM utilisateur WHERE idUser IN (";
        foreach($userIds as $user_id) {
            $query .= $user_id.",";
        }
        $query = rtrim($query, ",");
        $query .= ")";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
    }
    
    
}
?>

