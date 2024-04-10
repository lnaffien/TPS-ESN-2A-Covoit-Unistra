<?php
namespace Application\Models\Homepage;

// Définition de la classe Utilisateur
class User
{
    // Propriétés (variables) de l'utilisateur
    private $_id;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_telephone;
    private $_nagenda;
    private $_friends = array();

    /* Constructeur de la classe Utilisateur
     * Parametres : - nom
     *              - prenom
     *              - email
     *              - telephone
     *              - nagenda
     */
    public function __construct($id, $nom, $prenom, $email, $telephone, $nagenda, $friends)
    {
        $this->_id = $id;
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_email = $email;
        $this->_telephone = $telephone;
        $this->_nagenda = $nagenda;
        $this->_friends[] = $friends;
    }

    public function __get($property)
    {
        switch($property)
        {
            case 'id':
            {
                return $this->_id;
                break;
            }
            case 'nom':
            {
                return $this->_nom;
                break;
            }
            case 'prenom':
            {
                return $this->_prenom;
                break;
            }
            case 'email':
            {
                return $this->_email;
                break;
            }
            case 'telephone':
            {
                return $this->_telephone;
                break;
            }
            case 'nagenda':
            {
                return $this->_nagenda;
                break;
            }
            case 'friends':
            {
                return $this->_friends;
                break;
            }
            default:
            {
                throw new Exception('User : __get : Invalid Property {$property}');
            }                          
        } 

    }

    public function __set($property, $value)
    {
        switch($property)
        {
            case 'nom':
            {
                $this->_nom = $value;
                break;
            }
            case 'prenom':
            {
                $this->_prenom = $value;
                break;
            }
            case 'email':
            {
                $this->_email = $value;
                break;
            }
            case 'telephone':
            {
                $this->_telephone = $value;
                break;
            }
            case 'nagenda':
            {
                $this->_nagenda = $value;
                break;
            }          
            case 'friends':
            {
                $this->_friends = $value;
                break;
            }
            default:
            {
                throw new Exception('User : __set : Invalid Property {$property}');
            }                          
        } 

    }

    public function __compare_to($property, $value)
    {
        switch($property)
        {
            case 'id':
            {
                return $this->_id - $value;
                break;
            } 
            case 'nom':
            {
                return strcmp($this->_nom, $value);     // sensible a la casse
                break;
            }
            case 'prenom':
            {
                return strcmp($this->_prenom, $value);
                break;
            }
            case 'email':
            {
                return strcmp($this->_email, $value);
                break;
            }
            case 'telephone':
            {
                return strcmp($this->_telephone, $value);
                break;
            }
            case 'nagenda':
            {
                return $this->_nagenda - $value;
                break;
            }          
            case 'friends':
            {
                //$this->_friends = $value;
                //break;
            }
            default:
            {
                # TODO : look how to cleanly handle errors 
                throw new Exception('User : __set : Invalid Property {$property}');
            }                          
        } 

    }
}
?>

