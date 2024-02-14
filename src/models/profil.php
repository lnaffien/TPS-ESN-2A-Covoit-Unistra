<?php

namespace Application\Models\Profil;
use Application\Libs\Database\DatabaseConnection;
require_once('src/libs/database.php');

class Profil{
    
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }

    public function modif_profil(){
        // Récupération des informations de l'utilisateur
        $idUser = $_SESSION["idUser"];
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

        if(isset($_POST['ancienmdp'])) {
            // Le champ est rempli
            $ancienmdp = filter_input(INPUT_POST, 'ancienmdp', FILTER_DEFAULT);
        } else {
            // Le champ est vide
            $ancienmdp = null; 
        }
        
        $query = "SELECT mdp FROM utilisateur WHERE email = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute(array($_SESSION['email']));
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);


        // Vérification des informations de connexion
        if($row && password_verify($ancienmdp, $row['mdp'])) {
            // Les mots de passes sont identiques 
            if ($mdp == $confirm_mdp) {
                try{
                    $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
                    $query = "UPDATE utilisateur SET mdp=? WHERE idUser=?";
                    $stmt = $this->db->getConnection()->prepare($query);
                    $stmt->execute(array($hashed_mdp, $_SESSION['idUser']));
                }
                catch (Exception $e){
                    echo $e;
                }
            }
            // Les mots de passes ne correspndent pas
            else {
                $_SESSION['error'] = "Les mots de passe ne correspondent pas";
            }
        }
        else {
            $_SESSION['error'] = "Mot de passe incorrect";
        }

        // Ecriture dans la base de donnée de la colonne de gauche
        try{
            $query = "UPDATE utilisateur SET nom=?, prenom=?, email=?, numTel=?, numCalendrier=? WHERE idUser=?";
            $stmt = $this->db->getConnection()->prepare($query);
            $stmt->execute(array($nom, $prenom, $email, $numTel, $numCalendrier, $idUser));
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['numCalendrier'] = $numCalendrier;
            $_SESSION['numTel'] = $numTel;
        }
        catch (Exception $e){
            echo $e;
        }
      
    }

}
?>
