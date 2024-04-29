<?php

require_once('src/Model/Database_manager.php');
require_once('src/Model/User.php');


class Carpooling_Database_manager
{
    public static function add_carpooling_history($data)
    {
        if (!isset($data['dateCovoiturage'], $data['idUser'], $data['idUserAmi'], $data['status'], $data['aller'], $data['retour'])) {
            return false; 
        }
        return Database_manager::add_data('historique', $data);
    }

    public static function get_awaiting_requests($userId)
    {
        require_once('src/Model/Database_manager.php');

        $query = "SELECT historique.dateCovoiturage, utilisateur.nom, utilisateur.prenom, historique.aller, historique.retour, historique.idCovoiturage 
                  FROM historique 
                  INNER JOIN utilisateur ON historique.idUser = utilisateur.idUser 
                  WHERE historique.idUserAmi = :userId AND historique.status = 'awaiting'";
  
        $params = array(':userId' => $userId); // Parameters for the query
        $result = Database_manager::execute_query($query, $params);
        $awaitingRequests = $result->fetchAll(PDO::FETCH_ASSOC);

        return $awaitingRequests;
    }

    public static function get_accepted_requests($userId)
    {
        require_once('src/Model/Database_manager.php');

        $query = "SELECT historique.dateCovoiturage, utilisateur.nom, utilisateur.prenom, historique.aller, historique.retour, historique.idCovoiturage 
                  FROM historique 
                  INNER JOIN utilisateur ON historique.idUser = utilisateur.idUser 
                  WHERE historique.idUserAmi = :userId AND historique.status = 'accepted'";
  
        $params = array(':userId' => $userId); // Parameters for the query
        $result = Database_manager::execute_query($query, $params);
        $awaitingRequests = $result->fetchAll(PDO::FETCH_ASSOC);

        return $awaitingRequests;
    }
    

    public static function update_request_status($requestId, $newStatus)
    {
        require_once('src/Model/Database_manager.php');

        $table = 'historique';
        $properties = array('status' => $newStatus);
        $filter = "WHERE idCovoiturage = $requestId";
        
        return Database_manager::update_data($table, $properties, $filter);
    }

   /* public static function update_request_status($requestId, $newStatus)
    {
        require_once('src/Model/Database_manager.php');

        $table = 'historique';
        $properties = array('status' => $newStatus);
        $filter = "WHERE idCovoiturage = :requestId";
        $params = array(':status' => $newStatus, ':requestId' => $requestId);
        $query = "UPDATE $table SET " . Database_manager::properties_to_string_for_update($properties) . " $filter";
        
        return Database_manager::execute_query($query, $params);
    }*/
}
?>