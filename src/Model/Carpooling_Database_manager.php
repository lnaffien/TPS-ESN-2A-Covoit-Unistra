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

        // Query to fetch awaiting requests for the given user id
        $query = "SELECT historique.dateCovoiturage, utilisateur.nom, utilisateur.prenom, historique.aller, historique.retour, historique.idCovoiturage 
                  FROM historique 
                  INNER JOIN utilisateur ON historique.idUser = utilisateur.idUser 
                  WHERE historique.idUserAmi = :userId AND historique.status = 'awaiting'";

        // Parameters for the query
        $params = array(':userId' => $userId);

        // Execute the query
        $result = Database_manager::execute_query($query, $params);

        // Fetch the results
        $awaitingRequests = $result->fetchAll(PDO::FETCH_ASSOC);

        return $awaitingRequests;
    }
}
?>