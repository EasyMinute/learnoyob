<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('html_errors', '1');
error_reporting(E_ALL);



define('ROOT_PATH', dirname(__FILE__) );

include ROOT_PATH . "/includes/Class-Authorization.php";
include ROOT_PATH . "/includes/Class-User.php";


$authorization = new Authorization();

$user = new User();

$authorization->create_form_frontend();
$user->is_user_logged_in(); 


?>