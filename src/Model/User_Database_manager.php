<?php

require_once('src/Model/Database_manager.php');
require_once('src/Model/User.php');

class User_Database_manager
{
    public static function get_users_from_email($email)
    {
        return Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$email\"");
    }

    public static function get_user_from_id($id)
    {
        return Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$id\"");
    }

    public static function add_user($user, $mdp)
    {
        // TODO
    }

    public static function remove_user($user, $mdp)
    {

    }

    public static function add_friend($user_current, $user_to_add)
    {
        if($user_current->add_friend($user_to_add) && Database_manager::add_friend($user_current, $user_to_add))
        {
            return true;
        }
        // TODO : Gestion des erreurs
        return false;

    }

    public static function remove_friend($user_current, $user_to_remove)
    {
        if($user_current->remove_friend($user_to_remove) && Database_manager::remove_friend($user_current, $user_to_add))
        {
            return true;
        }
        // TODO : Gestion des erreurs
        return false;
    }




}

?>