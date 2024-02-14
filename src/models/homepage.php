<?php

namespace Application\Models\Homepage;
use Application\Libs\Database\DatabaseConnection;
require_once('src/libs/database.php');


// Start modifications for showing agenda
use Sabre\VObject;

require_once 'src/libs/composer/vendor/autoload.php';
// End of modifications for showing agenda

class Homepage{
    private $email;
    private $mdp;
    private $row;
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }

    public function stockDatas(){
        // Récupération des données du formulaire
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->mdp = filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT);

        // Validation de l'email
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
            // Email erroné -> retour login vide
            // require_once('views/login.php');
            return false;
        }

        $query = "SELECT * FROM utilisateur WHERE email = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute(array($this->email));
        $this->row=$stmt->fetch(\PDO::FETCH_ASSOC);
        
        $timezone = new \DateTimeZone('Europe/Paris');
        $today = (new \DateTime())->setTimezone($timezone);

        // Vérification des informations de connexion
        if($this->row && password_verify($this->mdp, $this->row['mdp'])) 
        {

            // Stockage des informations de l'utilisateur en session
            $_SESSION['idUser'] = $this->row['idUser'];
            $_SESSION['nom'] = $this->row['nom'];
            $_SESSION['prenom'] = $this->row['prenom'];
            $_SESSION['email'] = $this->row['email'];
            $_SESSION['numCalendrier'] = $this->row['numCalendrier'];
            $_SESSION["numTel"] = $this->row['numTel'];
            $_SESSION['connecte'] = true;
            $_SESSION['dateSelected'] = $today->format('Y-m-d');
            $_SESSION['userSelected'] = "";


            return true;
            // require('views/homepage.php');
            
            
        } 
        else 
        {
            // Mdp erroné -> retour login vide 
            $_SESSION['error'] = "Identifiant ou mot de passe incorrect";
            return false;
            //require_once('views/login.php');
        }
    }
}


class Agenda
{
    public string $idUser;
    public string $nom;
    public string $prenom;
    public string $numCalendrier;    
}

class Agendas{
    private $db;

    public function __construct(DatabaseConnection $db) {
        $this->db = $db;
    }
    public function getUsers(): array
    {
        $query = "SELECT * FROM utilisateur";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupère l'utilisateur connecté.
    public function getCurrentUser(int $idCurrentUser): array{
        $query = "SELECT * FROM utilisateur WHERE idUser =:idUser";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute(['idUser' => $idCurrentUser]);
        return $stmt->fetch();
    }

    // Retourne une liste avec Date du jour / heure début et heure fin
    public function parseCalendar(string $numCalendar): array {
        // Changer fuseau horaire
        $timezone = new \DateTimeZone('Europe/Paris');

        // Récupération du contenu de l'url ical
        $calendarData = file_get_contents("https://adecons.unistra.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=" . $numCalendar ."&projectId=1&calType=ical&nbWeeks=4");
        // Parsing du calendrier
        $calendar = VObject\Reader::read($calendarData);

        // Tri des événements par date de début
        $events = $calendar->getBaseComponents('VEVENT');
        usort($events, function($a, $b) {
            return $a->DTSTART->getDateTime() <=> $b->DTSTART->getDateTime();
        });
        $agenda = $this->getDatesAndTimes($events);
        // Afficher dans l'ordre chronologique les jours de travail avec les heures de début/fin de chaque journée
        usort($agenda, function($a, $b) {
            return $a <=> $b;
        });
        return $agenda;
    }

    public function getDatesAndTimes($events) {
        // Changer fuseau horaire
        $timezone = new \DateTimeZone('Europe/Paris');
        $dates = array();
        foreach ($events as $event) {
            $startDate = (new \DateTime((string)$event->DTSTART))->setTimezone($timezone);
            $endDate = (new \DateTime((string)$event->DTEND))->setTimezone($timezone);
            $date = $startDate->format('Y-m-d');
            if (!isset($dates[$date])) {
                $dates[$date] = array('start' => $startDate, 'end' => $endDate);
            } else {
                if ($startDate < $dates[$date]['start']) {
                    $dates[$date]['start'] = $startDate;
                }
                if ($endDate > $dates[$date]['end']) {
                    $dates[$date]['end'] = $endDate;
                }
            }
        }
        $result = array();
        foreach ($dates as $date => $times) {
            $result[] = array('heureDebut' => $times['start'], 'heureFin' => $times['end']);
        }
        return $result;
    }

    // Compare 2 calendriers (date / heure début / heure fin) et renvoie les intervalles début / fin pour chaque jour si possible, ne renvoie rien si IMPOSSIBLE (ex: pas de travail pour l'un)
    public function compareCalendar(array $calendarCurrentUser, array $calendarOtherUser){
        // Tableau qui comprendra toutes les informations sous la forme suivante :
        // DateTime DateDuJour, DateInterval IntervalleTempsAller, DateInterval IntervalleTempsRetour.
        $intervalleCalendar = array();
        // Si les jours sont pareils faire les opérations
        foreach ($calendarCurrentUser as $user_A){
            foreach($calendarOtherUser as $user_B){
                if ($user_A['heureDebut']->format('Y-m-d') == $user_B['heureDebut']->format('Y-m-d')){

                    $intervalleCalendar[] = array(  'dateJour' => $user_A['heureDebut'],
                                                    'intervalleDebut' => $user_A['heureDebut']->diff($user_B['heureDebut']),
                                                    'intervalleFin' => $user_A['heureFin']->diff($user_B['heureFin']));
                    // Sortie du foreach -> optimisation
                    break;
                }
            }
        }
        return $intervalleCalendar;
    }

    // En récupérant l'id de l'utilisateur connecté, réalise les calculs pour renvoyer dans un tableau :
    // Nom/Prénom des utilisateurs, la date de chaque jour, l'heure de début de chacun, l'heure de fin de chacune, l'intervalle de temps avec l'utilisateur connecté.
    public function getAgendas(int $idCurrentUser){
        $dateDuJour = new \DateTime();
        $timezone = new \DateTimeZone('Europe/Paris');
        $dateDuJour->setTimezone($timezone);

        setlocale(LC_TIME, 'fr_FR');

        $next28Days = array();
        for ($i = 1; $i <= 28; $i++) {
            $next28Days[] = $dateDuJour->format('Y-m-d');
            // Ajout de 1 jour à la date courante
            $dateDuJour->add(new \DateInterval('P1D'));
        }

        $datasUsers = array();

        $allUsers = $this->getUsers();
        $currentUser = $this->getCurrentUser($idCurrentUser);

        $calendarCurrentUser = $this->parseCalendar(strval($currentUser['numCalendrier']));
        foreach ($allUsers as $user){
            if ($user['idUser'] != $currentUser['idUser']){
                $calendarUser = $this->parseCalendar(strval($user['numCalendrier']));
                $datasComparaison = $this->compareCalendar($calendarCurrentUser, $calendarUser);

                foreach($next28Days as $day){
                    foreach($calendarCurrentUser as $calendarCurrentUserData){
                        foreach($datasComparaison as $dataComparaison){
                            foreach($calendarUser as $calendarUserData){
                                // Pour chaque jour :
                                if ($day == $dataComparaison['dateJour']->format('Y-m-d') 
                                    && $day == $calendarUserData['heureDebut']->format('Y-m-d') 
                                    && $day == $calendarUserData['heureFin']->format('Y-m-d')
                                    && $day == $calendarCurrentUserData['heureDebut']->format('Y-m-d')
                                    && $day == $calendarCurrentUserData['heureFin']->format('Y-m-d')){
                                
                                    $heureFinCorrespondance = min($calendarUserData['heureFin'], $calendarCurrentUserData['heureFin']);
                                    $heureDebutCorrespondance = max($calendarUserData['heureDebut'], $calendarCurrentUserData['heureDebut']);
                                    
                                    $journeeTotaleFin = max($calendarUserData['heureFin'], $calendarCurrentUserData['heureFin']);
                                    $journeeTotaleDebut = min($calendarUserData['heureDebut'], $calendarCurrentUserData['heureDebut']);
                                    
                                    // Vérification si il y a une correspondance
                                    if ($heureDebutCorrespondance < $heureFinCorrespondance){
                                        $compatibilitePourcentage = round((($heureFinCorrespondance->diff($heureDebutCorrespondance)->h)/($journeeTotaleFin->diff($journeeTotaleDebut)->h))*100);
                                        $heureFinCorrespondance = min($calendarUserData['heureFin'], $calendarCurrentUserData['heureFin']);
                                        $heureDebutCorrespondance = max($calendarUserData['heureDebut'], $calendarCurrentUserData['heureDebut']);
                                    }
                                    else { 
                                        $compatibilitePourcentage = 0;
                                        $heureFinCorrespondance = max($calendarUserData['heureDebut'], $calendarCurrentUserData['heureDebut']);
                                        $heureDebutCorrespondance = min($calendarUserData['heureFin'], $calendarCurrentUserData['heureFin']);
                                    }
                                    
                                    // Texte retourné en fonction du taux de compatibilité
                                    if($compatibilitePourcentage == 0) { 
                                        $compatibiliteTexte = "Aucun créneau en commun";
                                        $compatibiliteEtat = -1;
                                    }
                                    elseif ($compatibilitePourcentage <= 33) { 
                                        $compatibiliteTexte = "Compatibilité mauvaise"; 
                                        $compatibiliteEtat = 0;
                                    }
                                    elseif ($compatibilitePourcentage > 66) {
                                        $compatibiliteTexte = "Compatibilité bonne";
                                        $compatibiliteEtat = 2;
                                    }
                                    else { 
                                        $compatibiliteTexte = "Compatibilité moyenne";
                                        $compatibiliteEtat = 1;
                                    }

                                    $correspondance = array('journeeTotaleDebut' => $journeeTotaleDebut,
                                                            'journeeTotaleFin' => $journeeTotaleFin,
                                                            'heureDebutCorrespondance' => $heureDebutCorrespondance,
                                                            'heureFinCorrespondance' => $heureFinCorrespondance,
                                                            'pourcentage' => $compatibilitePourcentage,
                                                            'texte' => $compatibiliteTexte,
                                                            'etat' => $compatibiliteEtat);
                                    // Tableaux qui sera renvoyé
                                    $datasUsers[] = array(  'user' => $user,
                                                            'dateJour' => $calendarCurrentUserData['heureDebut']->format('Y-m-d'),
                                                            'calendarCurrentUserData' => $calendarCurrentUserData,
                                                            'calendarUserData' => $calendarUserData,
                                                            'correspondance' => $correspondance,
                                                            'dataComparaison' => $dataComparaison);
                                    
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $datasUsers;
    }

    public function sortAgendasDay(){
        $agendas = $this->getAgendas($_SESSION['idUser']);
        $agendaByDay = array();

        // Création d'un tableau associatif pour stocker les données pour chaque jour
        $datasByDay = array_reduce($agendas, function ($result, $data) {
            $dateJour = $data['dateJour'];
            if (!isset($result[$dateJour])) {
                $result[$dateJour] = [];
            }
            $result[$dateJour][] = $data;
            return $result;
        }, []);
        ksort($datasByDay);

        // Affichage des tableaux de données pour chaque jour
        foreach ($datasByDay as $dateJour => $datas) {
            // Afficher dans l'ordre chronologique les jours de travail avec les heures de début/fin de chaque journée
            usort($datas, function($a, $b) {
                if ($a['correspondance']['pourcentage']  == $b['correspondance']['pourcentage'] ) {
                    return 0;
                }
                return ($a['correspondance']['pourcentage']  < $b['correspondance']['pourcentage'] ) ? 1 : -1;   
            });
           
            $agendaByDay[] = $datas;
        }
        return $agendaByDay;
    }

    public function getAgendas7Days(){
        $days = $this->sortAgendasDay();
        $dateJ1 = $_SESSION['dateSelected'];
        $dateJ7 = date('Y-m-d', strtotime($dateJ1 . ' + 7 days'));

        $agendaSemaine = [];

        foreach ($days as $day) {
            // Si la date de l'événement est entre J0 et J+7
            if ($day[0]['dateJour'] >= $dateJ1 && $day[0]['dateJour'] <= $dateJ7) {
                // Ajout de l'événement au tableau de la semaine
                if (date('N', strtotime($day[0]['dateJour'])) != 6 && date('N', strtotime($day[0]['dateJour'])) != 7) {
                    foreach($day as $dayPerUser){
                        if (stripos(($dayPerUser['user']['nom'] . " " . $dayPerUser['user']['prenom']) , $_SESSION['userSelected']) !== false 
                            || stripos(($dayPerUser['user']['prenom'] . " " . $dayPerUser['user']['nom']) , $_SESSION['userSelected']) !== false) {
                                
                                // Ajout de l'événement au tableau résultat
                                $agendaSemaine[] = $dayPerUser;
                        }
                    }
                }
            }
        }
        return $agendaSemaine;
    }

    public function getWeek(){
        $date = $_SESSION['dateSelected'];

        // Tableau de dates
        $date_array = array();

        // Ajouter la date de départ au tableau
        $date_array[] = $date;
        
        // Ajouter les 7 prochains jours au tableau
        for ($i = 1; $i < 5; $i++) {
            $nextDate = date('Y-m-d', strtotime($date . ' +' . $i . ' weekday'));
            $date_array[] = $nextDate;
        }

        return $date_array;
    }

    public function sortAgendasUser(int $idUser){
        $agendas = $this->getAgendas($_SESSION['idUser']);        
        
        // initialisation du tableau qui contiendra les tableaux triés par idUser
        $datasUsersById = array();

        // parcours du tableau initial
        foreach ($agendas as $dataUser) {
            // récupération de la valeur idUser
            $idUser = $dataUser['user']['idUser'];
            
            // vérification si l'entrée pour cet idUser existe déjà dans le tableau trié
            if (!isset($datasUsersById[$idUser])) {
                // si non, initialisation de l'entrée avec un tableau vide
                $datasUsersById[$idUser] = array();
            }

            // Afficher dans l'ordre chronologique les jours de travail avec les heures de début/fin de chaque journée
            usort($dataUser, function($a, $b) {
                if ($a['compatibilitePourcentage'] == $b['compatibilitePourcentage']) {
                    return 0;
                }
                return ($a['compatibilitePourcentage'] < $b['compatibilitePourcentage']) ? 1 : -1;   
            });

            // ajout du tableau courant à l'entrée correspondant à l'idUser
            $datasUsersById[$idUser][] = $dataUser;
        }

        // le tableau $datasUsersById contient maintenant des sous-tableaux triés par idUser
        return $datasUsersById[$idUser];
    }

    public function useFilters($date, $search){
        $_SESSION['dateSelected'] = $date;
        $_SESSION['userSelected'] = $search;
    }
}

?>