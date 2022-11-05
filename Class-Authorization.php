<?php 
/**
 * Class Authorization
 */
class Authorization 
{

	public const SERVERNAME = "localhost";
	public const USERNAME = "learning_user";
	public const PASSWORD = "learning_password";
	public const DATABASE = "learn_Task1_authorization";


	
					
	public function __construct()
	{
		
		$this->conn = new mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD);

		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
	}

	private function create_database()
	{
		$sql = "CREATE DATABASE learn_Task1_authorization";

		if ($this->conn->query($sql) === TRUE) {
			echo "Database created successfully";
		} else {
			echo "Error creating database: " . $this->conn->error;
		}
	}

	public function create_form_frontend() {

		require ROOT_PATH . "/frontend-parts/login-form.php";
	}

}
?>