<?php

/**
 * Class Authori
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

	public function create_form_frontend()
	{
		?>
			<h1>
				Hello blyad!
			</h1>
			<form method="post" action="/">
				<input type="text" name="login">
				<input type="password" name="password">
				<input type="submit" value="Submit">
			</form>
		<?php
	}

}

class User extends Authorization
{
	public $username;
	public $userpass;
	public $userhash;
	public $conn;

	public function __construct()
	{	

		$this->conn = new mysqli(parent::SERVERNAME, parent::USERNAME, parent::PASSWORD, parent::DATABASE);

		if (isset($_POST['login'])) {
			$this->username = $_POST['login'];
		} else {
			$this->username = false;
		}
		if (isset($_POST['password'])) {
			$this->userpass = $_POST['password'];
		} else {
			$this->userpass = false;
		}

	}

	private function check_user(){
		if (!$this->username || !$this->userpass) {
			return false;
		}

		$sql = "SELECT * FROM users 
			WHERE username = '$this->username' 
			AND password = '$this->userpass' ;";

		// var_dump($sql);

		$result = $this->conn->query($sql);
		
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function is_user_logged_in()
	{
		if ($this->check_user()) {
			echo 'Вітаю, ти залогінився! Твій хеш:' . hash('md5', $this->username);
		} else {
			echo 'Бля, треба залогінитись';
		}
	}



}




$authorization = new Authorization();

$user = new User();

$authorization->create_form_frontend();
$user->is_user_logged_in();












?>

