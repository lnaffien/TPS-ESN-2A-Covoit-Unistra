<?php

require_once('src/Model/Database_manager.php');
require_once('src/Model/User.php');

class User_Database_manager
{
	/********************************************************************************
	 * 							UTILITIES											*
	 * 								Private functions used by the public ones		*
	 ********************************************************************************/

	/* mail_already_exists : Check if an user with the given email address exists in the database
	 * Parameter : mail : Mail address to check in the database
	 * Return : True if the given email address is associated to an existing user, false otherwise
	 */
	private static function mail_already_exists($mail)
	{
		$query_result = Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$mail\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}

	/* id_exists : Check if an user with the given id exists in the database
	 * Parameter : id : Number to check in the database
	 * Return : True if the given id is associated to an existing user, false otherwise
	 */
	private static function id_exists($id)
	{
		$query_result = Database_manager::get_data('UTILISATEUR', '*', "WHERE idUser=\"$id\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}

	/* relationship_exists : Check if a relationship between 2 users exists in the database
	 * Parameters : - user_current : 
	 * 			    - user_to_add  :  
	 * Return : True if a relationship between the given users exists, false otherwise
	 */
	private static function relationship_exists($user_current, $user_to_add)
	{
		$user_current_id = $user_current->__get('id');
		$user_to_add_id = $user_to_add->__get('id');

		$query_result = Database_manager::get_data('AMI', '*', "WHERE idUtilisateur=\"$user_current_id\" AND idUtilisateurAmi=\"$user_to_add_id\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}

	/* get_basic_properties : Set the basic properties of the given user.
	 *		It includes : 'nom', 'prenom', 'email', 'agenda' and 'telephone'.
	 *		If null or empty, 'telephone' is ignored.
	 * Parameter : user : User data to get the properties.
	 * Return : A dictionnary with above properties containing the user data.
	 */
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


	/************************************************************************************
	 * 							DATABASE QUERIES										*
	 * 								Public functions to access data related to users	*
	 ************************************************************************************/

	/* get_users_from_email : Get all users in the database with the given email address.
	 * Parameter : email : Email address of the user(s) to get.
	 * Return : User(s) data registered with the given email. Needs to be fetch into an array to be read.
	 */
    public static function get_users_from_email($email)
    {
        return Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$email\"");
    }

	/* get_user_from_id : Get all users in the database with the given id.
	 * Parameter : id : Id of the user to get.
	 * Return : User data registered with the given id. Needs to be fetch into an array to be read.
	 */
    public static function get_user_from_id($id)
    {
        return Database_manager::get_data('UTILISATEUR', '*', "WHERE idUser=\"$id\"");
    }

	/* get_users_from_name : Get all users in the database containing the given first or last name.
	 * Parameters : - first_name : Part of the first name of the user to search for.
	 * 				- last_name  : Part of the last name of the user to search for.
	 * Return : Users data registered with the given first or last name, order by their last name, then by their first name.
	 * 			Needs to be fetch into an array to be read.
	 */
	public static function get_users_from_name($first_name, $last_name)
    {
        return Database_manager::get_data('UTILISATEUR', '*', "WHERE (nom LIKE \"%$last_name%\") OR (nom LIKE \"%$first_name%\") OR (prenom LIKE \"%$first_name%\") OR (prenom LIKE \"%$last_name%\") ORDER BY nom, prenom ASC");
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

	public static function get_friend($user)
	{
		return Database_manager::get_data("AMI", "*", "WHERE idUtilisateur=\"" . $user->__get("id") . "\"");
	}

	public static function add_friend($user_current, $user_to_add)
    {
		// TODO : tester si les id existent ? -> pas besoin car comme c'est une FK la bdd va retourner une erreur si elle n'existe pas

		// Check if relationship already exists
		if(User_Database_manager::relationship_exists($user_current, $user_to_add))
		{
			print_r("Error while adding data to friend table : Relationship already exists\n");
			return false;
		}

		// Set data to add
		$properties = (array( "idUtilisateur" => $user_current->__get("id"),
								"idUtilisateurAmi" => $user_to_add->__get("id") ));

		// Add friend data
		$user_current->add_friend($user_to_add);
        return Database_manager::add_data("AMI", $properties);
    }

	public static function remove_friend($user_current, $user_to_remove)
    {
		// Check if relationship already exists
		if( !User_Database_manager::relationship_exists($user_current, $user_to_remove))
		{
			print_r("Error while updating table : Relationship doesn't exists\n");
			return false;
		}

		// Set the filter to select the relationship to remove
		$filter = "WHERE idUtilisateur=\"" . $user_current->__get("id") . "\" AND idUtilisateurAmi=\"" . $user_to_remove->__get("id") . "\"";
		
		// Remove friend
		$user_current->remove_friend($user_to_remove);
		return Database_manager::delete_data("AMI", $filter);
    }

}

?>