<?php

// Définition de la classe Utilisateur
class User
{
    // Propriétés (variables) de l'utilisateur
    private $_idUser;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_telephone;
    private $_nagenda;
    private $_friends = array();

    /* Constructeur de la classe Utilisateur
     * Parametres : - idUser
     *              - nom
     *              - prenom
     *              - email
     *              - telephone
     *              - nagenda
     *              - friends
     */
    public function __construct($idUser, $nom, $prenom, $email, $telephone, $nagenda, $friends)
    {
        $this->_idUser = $idUser;
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_email = $email;
        $this->_telephone = $telephone;
        $this->_nagenda = $nagenda;

        if(isset($friends))
        {
            $this->_friends[] = $friends;
        }
        
    }

    public function __get($property)
    {
        switch($property)
        {
            case 'id' :
            {
                return $this->_idUser;
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
                throw new Exception("User : __get : Invalid Property {$property}");
            }                          
        } 

    }

    public function __set($property, $value)
    {
        if(isset($value))
        {
            
            switch($property)
            {
                case 'id' :
                {
                    $this->_id = $value;
                    break;
                }
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
    }

    public function __set_all_personal_data($nom, $prenom, $email, $telephone, $nagenda)
    {
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_email = $email;
        $this->_telephone = $telephone;
        $this->_nagenda = $nagenda;
    }

    public function compare_to($property, $value)
    {
        if(!isset($value))
        {
            # TODO : look how to cleanly handle errors
            return false;
        }

        switch($property)
        {
            case 'id':
            {
                return $this->_idUser - $value; // TODO : 0 = faux
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
                return $this->_nagenda - $value; // TODO : 0 = faux
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

    private function friend_in_array($friend)
    {
        return array_search($friend, $this->_friends);
    }

    public function add_friend($friend_to_add)
    {
        if(!$this->friend_in_array($friend_to_add))
        {
            $this->_friends[] = $friend_to_add;
            return true;
        }
        else
        {
            // TODO : erreur : this user is already your friend
            return false;
        }
    }

    /*
     * false = 0 -> il y a eu un problème avec au moins 1 ami
     * true = 1
     */
    public function add_friends($friends_to_add)
    {
        $result = true;

        foreach($friends_to_add as $friend)
        {
            $result &= $this->add_friend($friend);
        }
        return $result;
    }

    public function remove_friend($friend_to_remove)
    {
        $friend_key = friend_in_array($friend_to_remove);
        if($friend_key)
        {
            unset($this->_friends[$friend_key]);
            return true;
        }
        else
        {
            // TODO : erreur : this user is not your friend !
            return false;
        }
    }

    public function remove_friends($friends_to_remove)
    {
        $result = true;

        foreach($friends_to_remove as $friend)
        {
            $result &= $this->remove_friend($friend);
        }
        return $result;
    }
}
?>

