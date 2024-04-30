<?php

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
		$query = ("SELECT $property FROM $table $filter");
		$stmt = Database_manager::get_connection()->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	
	private static function properties_values_to_string($properties)
	{
		$properties_string = "\"";
		$properties_string .= implode("\", \"", $properties);
		$properties_string .= "\"";

		return $properties_string;
	}

	private static function properties_keys_to_string($properties)
	{
		$properties_string = "";
		$keys = array_keys($properties);
		return implode(", ", $keys);
	}

	private static function properties_to_string_for_update($properties)
	{
		$properties_string = "";
		foreach($properties as $key => $value)
		{
			$properties_string .= "$key=\"$value\", ";
		}

		return substr($properties_string, 0, -2);
	}

	public static function add_data($table, $properties)
	{		
		try
		{
			$query = "INSERT INTO $table (" .
						Database_manager::properties_keys_to_string($properties) .
						") VALUES (" .
						Database_manager::properties_values_to_string($properties) .
						")";
						print("$query <br/>");
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute();
			
		} catch (Exception $e)
		{
			// TODO : Gestion des erreurs
			print_r("Error while adding data into data table : $e");
			$stmt->rollback();
			return false;
		}
		return true;
	}

	public static function update_data($table, $properties, $filter)
	{
		try
		{
			$query = "UPDATE $table SET " .
						Database_manager::properties_to_string_for_update($properties) .
						" $filter";
			//echo ("$query <br/>");
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute();
		} catch (Exception $e)
		{
			// TODO : Gestion des erreurs
			print_r("Error while updating data table : $e");
			$stmt->rollback();
			return false;
		}
		return true;
	}

	public static function delete_data($table, $filter)
	{
		try
		{
			$query = "DELETE FROM $table $filter";
			$stmt = Database_manager::get_connection()->prepare($query);
			$stmt->execute();

		} catch (Exception $e)
		{
			print_r("Error while deleting data from data table : $e");
			$stmt->rollback();
			return false;
		}
		return true;
	}


	    /**
     * Executes a SQL query with optional parameters.
     *
     * @param string $query The SQL query to execute.
     * @param array $params Optional parameters for the query.
     * @return PDOStatement The PDOStatement object representing the result of the query.
     */
    public static function execute_query($query, $params = array())
    {
        try {
            $stmt = self::get_connection()->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            // Handle the exception here (e.g., log it, display an error message)
            echo "Error executing query: " . $e->getMessage();
            return null;
        }
    }




	

}

?>