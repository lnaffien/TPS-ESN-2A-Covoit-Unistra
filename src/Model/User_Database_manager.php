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

	private static function mail_already_exists($mail)
	{
		$query_result = Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$mail\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}

	private static function id_exists($id)
	{
		$query_result = Database_manager::get_data('UTILISATEUR', '*', "WHERE idUser=\"$id\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}

	private static function relationship_exists($user_current, $user_to_add)
	{
		$user_current_id = $user_current->__get('id');
		$user_to_add_id = $user_to_add->__get('id');

		$query_result = Database_manager::get_data('AMI', '*', "WHERE idUtilisateur=\"$user_current_id\" AND idUtilisateurAmi=\"$user_to_add_id\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}


	private static function get_basic_properties($user)
	{
        $properties = array (
								'nom' => $user->__get('nom'),
								'prenom' => $user->__get('prenom'),
								'email' => $user->__get('email'),
								'nagenda' => $user->__get('nagenda') 
							);

		if($user->__get('telephone') != null)
		{
			$properties['telephone'] = $user->__get('telephone');
		}

		return $properties;
	}

    public static function add_user($user, $password)
    {
        // TODO : vérifier que les 2 mdp sont similaires ici ?
		// TODO : vérifier s'il y a des valeurs nulles ?
		// TODO : vérifier le type des paramètres ?
        
        // Check if user email already exists
		if(User_Database_manager::mail_already_exists($user->__get("email")))
		{
			print_r("User already exists\n");
			return false;
		}

        // Hash password
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Get current date
		date_default_timezone_set('Europe/Paris');
		$current_date = date("Y-m-d");

        // Set data to add
		$properties = User_Database_manager::get_basic_properties($user);		
		$properties['dateInscription'] = $current_date;
		$properties['motDePasse'] = $hashed_password;

        // Add data
		return Database_manager::add_data('UTILISATEUR', $properties);
    }

	public static function delete_user($user)
	{
		$filter = "WHERE email=\"" . $user->__get('email') . "\"";
		return Database_manager::delete_data('UTILISATEUR', $filter);
	}

	public static function update_user($new_user_data)
	{
		// Check if user exists
		if( !User_Database_manager::id_exists($new_user_data->__get('id')) )
		{
			print_r("Error while updating table : User does not exists\n");
			return false;
		}

		// Set data to update
		$properties = User_Database_manager::get_basic_properties($new_user_data);

		// Set filter
		$filter = "WHERE idUser=\"" . $new_user_data->__get('id') . "\"";

		// Update user data
		return Database_manager::update_data('UTILISATEUR', $properties, $filter);
	}

	public static function update_user_password($user, $password)
	{
        // Check if user exists
		if( !User_Database_manager::id_exists($new_user_data->__get('id')) )
		{
			print_r("Error while updating table : User does not exists\n");
			return false;
		}

		// Set data to update
		$properties['motDePasse'] = password_hash($password, PASSWORD_DEFAULT);

		// Set filter
		$filter = "WHERE idUser=\"" . $new_user_data->__get('id') . "\"";

		// Update user data
		return Database_manager::update_data('UTILISATEUR', $properties, $filter);
	}

	public static function add_friend($user_current, $user_to_add)
    {
		// TODO : tester si les id existent ?

		// Check if relationship already exists
		if(User_Database_manager::relationship_exists($user_current, $user_to_add))
		{
			print_r("Error while updating table : Relationship already exists\n");
			return false;
		}

		// Set data to update
		$properties = (array( "idUtilisateur" => $user_current->__get("id"),
								"idUtilisateurAmi" => $user_to_add->__get("id") ));

		// Update friend data
        return Database_manager::delete_data("AMI", $filter);
    }

	public static function remove_friend($user_current, $user_to_remove)
    {
		// Check if relationship already exists
		if( !User_Database_manager::relationship_exists($user_current, $user_to_remove))
		{
			print_r("Error while updating table : Relationship doesn't exists\n");
			return false;
		}
		$filter = "WHERE idUtilisateur=\"" . $user_current->__get("id") . "\" AND idUtilisateurAmi=\"" . $user_to_remove->__get("id") . "\"";
		return Database_manager::delete_data("AMI", $filter);
    }

}

?>