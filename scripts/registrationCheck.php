<?php
//includes database connection
require_once '../db_connect.php';

//includes session info
session_start();

//create account number and get date+time
$accountNumber = mt_rand(10000000, 20000000);
date_default_timezone_set("America/New_York");
$date = date("Y/m/d H:i:s");

//takes form input and assigns them to variables
$email = strtolower(trim($_POST['email']));
$password = trim($_POST['password']);
$repassword = trim($_POST['repassword']);
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$phoneNum = trim($_POST['phoneNum']);
$address = trim($_POST['address']);
$city = trim($_POST['city']);
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];

//checks if all required values are not empty
if (empty($email) || empty($password) || empty($repassword) || empty($firstName) || empty($lastName) || empty($phoneNum) || empty($address) || empty($city) || empty($state) || empty($zipcode)) {

	//redirects to registration page if all values are not input
	$_SESSION['registration_error'] = true;
	header('Location: ../register.php');

	//closes database connection
	$database = null;
	exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM customer WHERE email = :email");
$query->bindParam(':email', $email);

//gets any elements from database that has matching email values
$query->execute();
$result = $query->fetchAll();

//checks if email input is taken
if ($result) {
	//redirects to registration page
	$_SESSION['email_taken'] = true;
	header('Location: ../register.php');

	//closes database connection
	$database = null;
	exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM customer WHERE accountNumber = :accountNumber");
$query->bindParam(':accountNumber', $accountNumber);
$query->execute();
$result = $query->fetchAll();

//if generated account number is taken, make a new one
while ($result) {
	$accountNumber = mt_rand(10000000, 20000000);
	$query = $db->prepare("SELECT * FROM customer WHERE accountNumber = :accountNumber");
	$query->bindParam(':accountNumber', $accountNumber);
	$query->execute();
	$result = $query->fetchAll();
}

if ($password != $repassword) {
	//checks if passwords are the same
	if ($result) {
		//redirects to registration page
		$_SESSION['passMiss'] = true;
		header('Location: ../register.php');

		//closes database connection
		$database = null;
		exit();
	}
}

//hashes password
$password = password_hash($password, PASSWORD_DEFAULT);

//combines all address inputs
$fullAddress = $address . ' ' . $city . ' ' . $state . ' ' . $zipcode;

//prepares insert statement
$query = $db->prepare("INSERT INTO customer VALUES (:accountNumber, :email, :firstName, :LastName, :password, :fullAddress, :phoneNum, :date)");
$query->bindParam(':accountNumber', $accountNumber);
$query->bindParam(':email', $email);
$query->bindParam(':password', $password);
$query->bindParam(':firstName', $firstName);
$query->bindParam(':LastName', $lastName);
$query->bindParam(':phoneNum', $fname);
$query->bindParam(':fullAddress', $fullAddress);
$query->bindParam(':phoneNum', $phoneNum);
$query->bindParam(':date', $date);

//checks if insert was successful
if ($query->execute()) {
	//redirects to homepage if successful
	$_SESSION['reg_success'] = true;
	$_SESSION['logged_in'] = true;
	$_SESSION['email'] = $email;
	$_SESSION['account'] = $result['accountNumber'];
	$_SESSION['userType'] = 'customer';
	header("Location: ../homepage.php");
} else {
	//redirects to registration page if failed
	$_SESSION['registration_error'] = true;
	header('Location: ../register.php');
}

//closes database connection
$database = null;
exit();
