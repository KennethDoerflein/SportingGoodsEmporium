<?php
//includes database connection
require_once '../../db_connect.php';

//includes session info
session_start();

//checks if user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	//if already logged in, redirects user to homepage
	header('Location: ../adminHomepage.php');
}

//take input and assign to variables
$email = strtolower(trim($_POST['email']));
$password = trim($_POST['password']);

//check if all required variables are not empty
if (empty($email) || empty($password)) {

	//redirects to login page if any variables are null
	$_SESSION['login_error'] = true;
	header('Location: ../adminLogin.php');

	//closes database connection
	$database = null;
	exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM employee WHERE email = :email");
$query->bindParam(':email', $email);

//gets any elements from database that has matching email
$query->execute();
$result = $query->fetch();

//checks if user exists
if (!$result) {
	//redirects to login page
	$_SESSION['account_DNE'] = true;
	header('Location: ../adminLogin.php');

	//closes database connection
	$database = null;
	exit();
} else if (password_verify($password, $result['password'])) {
	$_SESSION['logged_in'] = true;
	$_SESSION['email'] = $email;
	$_SESSION['account'] = $result['employeeID'];
	$_SESSION['userType'] = 'admin';
	header('Location: ../adminHomepage.php');
} else {
	$_SESSION['invalid_password'] = true;
	header('Location: ../adminLogin.php');
}

//closes database connection
$database = null;
exit();
