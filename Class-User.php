<?php 
class User extends Authorization {
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
?>