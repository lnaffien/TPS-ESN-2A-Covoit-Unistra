<?php

namespace Application\Models\Register;
use Application\Libs\Database\DatabaseConnection;
require_once('src/libs/database.php');

class Register{
    private $db;
    private $count;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }

    public function is_empty($value) {
        return empty(trim($value));
    }

    public function newUser(){

        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT);
        $confirm_mdp = filter_input(INPUT_POST, 'confirm_mdp', FILTER_DEFAULT);
        $numCalendrier = filter_input(INPUT_POST, 'numCalendrier', FILTER_DEFAULT);
        $numTel = filter_input(INPUT_POST, 'numTel', FILTER_SANITIZE_SPECIAL_CHARS);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "Email non valide.";
            exit();
        }

        // Vérifie que tous les champs sont remplis
        if ($this->is_empty($nom) || $this->is_empty($prenom) || $this->is_empty($email) || $this->is_empty($mdp) || $this->is_empty($confirm_mdp) || $this->is_empty($numCalendrier)) 
        {
            echo "Please make sure to complete all the fields\n";
        } 
        else 
        {
            // Vérifie si l'e-mail existe déjà dans la base de données
            $query = "SELECT COUNT(*) FROM Utilisateur WHERE email = ?";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->execute(array($email));
            $this->count = $stmt->fetchColumn();

            if ($this->count > 0) 
            {
                echo "Un compte existe déjà avec cette adresse e-mail\n";
            } 
            else 
            {
                // Vérifie que les deux mots de passe sont identiques (coté serveur)
                if ($mdp == $confirm_mdp) {
                    date_default_timezone_set('Europe/Paris');
                    $DateInscription = date("Y-m-d");
                    // Hachage du mot de passe avec password_hash()
                    $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
                    $query = "INSERT INTO Utilisateur (nom, prenom, email, mdp, numCalendrier, numTel, DateInscription) VALUES(?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $this->db->getConnection()->prepare($query);
                    $stmt->execute(array($nom, $prenom, $email, $hashed_mdp, $numCalendrier, $numTel, $DateInscription));
                } 
                else 
                {
                    echo "Les mots de passe ne correspondent pas";
                }
            }
        }

    }
}

?>
