<?php

require_once('src/Model/User.php');

/**
 * TODO Auto-generated comment.
 */
class Database_manager
{
	private static $_host = 'localhost';
    private static $_port = '3306';
    private static $_database_name = 'appcovoit';
    private static $_username = 'root';
    private static $_password = 'root';

	private static ?\PDO $_database_connexion = null;

	/**
	 * TODO Auto-generated comment.
	 */
	private static function get_connection(): \PDO
	{
		if (Database_manager::$_database_connexion == null)
		{
			try
			{
				Database_manager::$_database_connexion = new \PDO('mysql:host=' . Database_manager::$_host . ';port=' . Database_manager::$_port . ';dbname=' . Database_manager::$_database_name, Database_manager::$_username, Database_manager::$_password);
				
			} catch (Exception $e)
			{
				//die("Database connection failure : " . $e->getMessage()); // die = exit -> pas idéal
				# TODO gérer l'erreur correctement
			}

			Database_manager::$_database_connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		// Ou, à la place du if :
		// (à éviter si on utilise PDO ODBC)
		// Connexion persistante = si elle existe déjà, n'en crée pas une nouvelle
		// Doit être indiqué dans le constructeur, ne fonctionne pas avec un setAttribute
		/*$this->_database_connexion = new \PDO('mysql:host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_database_name, $this->_username, $this->_password, array(PDO::ATTR_PERSISTENT => true) );
		$this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);*/		
		
		return Database_manager::$_database_connexion;
	}

	/**
	 * TODO Auto-generated comment.
	 */
	private static function disconnection()
	{
		Database_manager::$_database_connexion = null;		// oui, c'est la manière propre. PHP va détruire toutes les instances non utilisées, et donc la connexion à la bdd
	}

	/**
	 * TODO Auto-generated comment.
	 * $filter : string sql request to filter the data. Leave empty if none
	 */
	public static function get_data($table, $property, $filter)
	{
		$query_string = ("SELECT $property FROM $table $filter");	// Vraiment pas ouf à cause des injections de code
		$query = Database_manager::get_connection()->prepare($query_string);
		//$query = Database_manager::get_connection()->prepare("SELECT :property FROM :table :filter"); // possible que pour des valeurs de filtre, car "select '*' " n'est pas compréhensible en sql
		//$query->bindParam(':property', $property, PDO::PARAM_STR);
		//$query->bindParam(':table', $table, PDO::PARAM_STR);
		//$query->bindParam(':filter', $filter);
		$query->execute();

		return $query;
	}

	private static function mail_already_exists($mail)
	{
		$query_result = Database_manager::get_data('UTILISATEUR', '*', "WHERE email=\"$mail\"");
		$query_result_size = $query_result->fetchColumn();
		return ($query_result_size != 0) ? true : false;
	}

	/*private static function add_data_format_properties($properties)
	{
		$query_start_string = "(";
		$query_end_string = "VALUES(";
		$keys = array_keys($properties);

		foreach($keys as $key)
		{
			$query_start_string += "$key, ";
			$query_end_string += "$properties[$key], ";
		}

		// Remove excess characters 
		$query_start_string = rtrim($query_start_string, ",");
		$query_end_string = rtrim($query_start_string, ",");

		// Add missing characters
		$query_start_string += ") ";
		$query_end_string += ")";

		// Merge start and end string queries
		return $query_start_string + $query_end_string;
	}*/

	/*public static function add_data($table, $properties, $filter)
	{
		
		


		//(idUtilisateur, idUtilisateurAmi) VALUES(?, ?)";
	}*/

	public static function add_friend($user_current, $user_to_add)
	{
		// Check if the relationship doesn't exist
		if(Database_manager::get_data('AMI', '*', "WHERE idUtilisateur=$user_current AND idUtilisateurAmi=$user_to_add"));
		{
			//TODO : erreur car la relation existe déjà
			return false;
		}

		// Insert new relationship into data table
		try
		{
			$query = "INSERT INTO AMI (idUtilisateur, idUtilisateurAmi) VALUES(?, ?)";
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute(array(
							$user_current->__get("id"),
							$user_to_add->__get("id") ));
		} catch (Exception $e)
		{
			// TODO : Gestion des erreurs
			print_r("Error while adding new friend relationship into data table : $e");
			$stmt->rollback();
			return false;
		}
		return true;
	}

	public static function remove_friend($user_current, $user_to_remove)
	{
		// Check if the relationship exists
		if(!Database_manager::get_data('AMI', '*', "WHERE idUtilisateur=$user_current AND idUtilisateurAmi=$user_to_add"));
		{
			//TODO : erreur car la relation n'existe pas
			return false;
		}

		// Remove relationship from data table
		try
		{
			$query = "DELETE FROM AMI WHERE idUtilisateur=? AND idUtilisateurAmi=?";
			$stmt = Database_manager::get_connection()->prepare($query);

			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute(array(
							$user_current->__get("id"),
							$user_to_add->__get("id") ));
		} catch (Exception $e)
		{
			// TODO : Gestion des erreurs
			print_r("Error while removing data from relationship table : $e");
			$stmt->rollback();
			return false;
		}
		return true;
	}

	// TODO
	public static function add_user($user, $password) : bool
	{	
		// TODO : vérifier que les 2 mdp sont similaires

		// Check if user email already exists
		if(Database_manager::mail_already_exists($user->__get("email")))
		{
			print_r("User already exists\n");
			return false;
		}

		// Hash password
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		// Get current date
		date_default_timezone_set('Europe/Paris');
		$current_date = date("Y-m-d");

		// Insert new user into data table
		try
		{
			$query = "INSERT INTO UTILISATEUR (nom, prenom, email, motDePasse, nagenda, telephone, dateInscription) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute(array(
							$user->__get("nom"),
							$user->__get("prenom"),
							$user->__get("email"),
							$hashed_password,
							$user->__get("nagenda"),
							$user->__get("telephone"),
							$current_date ));
		} catch (Exception $e)
		{
			// TODO : Gestion des erreurs
			print_r("Error while adding new user into data table : $e");
			$stmt->rollback();
			return false;
		}

		return true;
	}

	protected static function delete_user($user)
	{
		try
		{
			$query = "DELETE FROM UTILISATEUR WHERE email=?";
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute(array( $user->__get("email") ));
		} catch (Exception $e)
		{
			print_r("Error while deleting user from data table : $e");
			$stmt->rollback();
			return false;
		}

		return true;
	}

	// TODO : comments
	// TODO : tableau de properties avec un begintransaction() ?
	public static function update_user($new_user_data, $property)
	{
		// Check if user email already exists
		if(!Database_manager::mail_already_exists($new_user_data->__get("email")))
		{
			print_r("Error while updating table : User does not exists\n");
			return false;
		}

		// Check if the property is updatable
		if($property == "idUser")
		{
			print_r("Error while updating table : Cannot change id value\n");
			return false;
		}
		
		// Update data table
		try
		{
			$property_value = $new_user_data->__get($property);
			$id_value = $new_user_data->__get("idUser");

			$query = "UPDATE UTILISATEUR SET $property=\"$property_value\" WHERE idUser=$id_value";
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute();
		} catch (Exception $e)
		{
			print_r("Error while updating user data : $e");
			$stmt->rollback();
			return true;
		}
	}
}

?>