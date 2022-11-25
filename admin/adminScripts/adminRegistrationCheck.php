<?php
//includes database connection
require_once '../../db_connect.php';

//includes session info
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ../adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if customer, redirects user to customer homepage
  header('Location: ../../homepage.php');
}

$employeeID = mt_rand(10000000, 20000000);
$salary = mt_rand(50000, 100000);
date_default_timezone_set("America/New_York");
$date = date("Y/m/d H:i:s");

//takes input and assigns them to variables
$email = strtolower(trim($_POST['email']));
$password = trim($_POST['password']);
$repassword = trim($_POST['repassword']);
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$phoneNum = trim($_POST['phoneNum']);

//checks if all required values are not empty
if (empty($email) || empty($password) || empty($repassword) || empty($firstName) || empty($lastName) || empty($phoneNum)) {

  //redirects to registration page if all values are not input
  $_SESSION['registration_error'] = true;
  header('Location: ../adminRegister.php');

  //closes database connection
  $database = null;
  exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM employee WHERE email = :email");
$query->bindParam(':email', $email);

//gets any elements from database that has matching email values
$query->execute();
$result = $query->fetchAll();

//checks if email input is taken
if ($result) {
  //redirects to registration page
  $_SESSION['email_taken'] = true;
  header('Location: ../adminRegister.php');

  //closes database connection
  $database = null;
  exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM employee WHERE employeeID = :employeeID");
$query->bindParam(':employeeID', $employeeID);
$query->execute();
$result = $query->fetchAll();

//if generated account number is taken, make a new one
while ($result) {
  $employeeID = mt_rand(10000000, 20000000);
  $query = $db->prepare("SELECT * FROM employee WHERE employeeID = :employeeID");
  $query->bindParam(':employeeID', $employeeID);
  $query->execute();
  $result = $query->fetchAll();
}

if ($password != $repassword) {
  //checks if passwords are the same
  if ($result) {
    //redirects to registration page
    $_SESSION['email_taken'] = true;
    header('Location: ../adminRegister.php');

    //closes database connection
    $database = null;
    exit();
  }
}

//hashes password
$password = password_hash($password, PASSWORD_DEFAULT);


//prepares insert statement
$query = $db->prepare("INSERT INTO employee VALUES (:employeeID, :email, :firstName, :LastName, :password, :phoneNum, :salary, :date)");
$query->bindParam(':employeeID', $employeeID);
$query->bindParam(':email', $email);
$query->bindParam(':firstName', $firstName);
$query->bindParam(':LastName', $lastName);
$query->bindParam(':password', $password);
$query->bindParam(':phoneNum', $phoneNum);
$query->bindParam(':date', $date);
$query->bindParam(':salary', $salary);

//checks if insert was successful
if ($query->execute()) {
  //redirects to homepage if successful
  $_SESSION['reg_success'] = true;
  header("Location: ../adminHomepage.php");
} else {
  //redirects to registration page if failed
  $_SESSION['reg_err'] = true;
  header('Location: ../adminRegister.php');
}

//closes database connection
$database = null;
exit();
