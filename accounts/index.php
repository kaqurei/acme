<?php
/*
* Accounts Controller
*/

 // Create or access a Session 
 session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the array of categories 
$categories = getCategories();

// Build a navigation bar using the $categories array
$navList = buildNav($categories);


// Test that function worked by uncommenting the following two lines
// var_dump($categories);
//	exit;

// Test function
// echo $navList;
// exit;

// Display view based on action
$action = filter_input(INPUT_POST, 'action');

 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'default';
  }
 }

 switch ($action) {

  //** ACTION: User is not logged in, My Account serves login page **//
  case 'login':
  include '../view/login.php';
  break;

  //** ACTION: User goes to register new account, served registration page **//
  case 'registration':
  include '../view/register.php';
  break;

  //** ACTION: User registers new account */
  case 'register':
// Filter and store the data
  $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
  $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientEmail = checkEmail($clientEmail);
  $checkPassword = checkPassword($clientPassword);

    // Verify that the email being registered is not already in the database
  $verifyEmail = verifyEmail($clientEmail);
  if($verifyEmail){
    $message = '<p class="notice">That email address has already been used to sign up. Please sign in or click register to try again.</p>';
    include '../view/login.php';
    exit;
   }
   

// Check for missing data
if(empty($clientFirstname)){
  $message = '<p>Please provide information for first name.</p>';
  include '../view/register.php';
  exit;
}
if(empty($clientLastname)){
  $message = '<p>Please provide information for last name.</p>';
  include '../view/register.php';
  exit;
}
if(empty($clientEmail)){
  $message = '<p>Please provide information for email address.</p>';
  include '../view/register.php';
  exit;
}
if(empty($checkPassword)){
  $message = '<p>Please provide valid information for password.</p>';
  include '../view/register.php';
  exit;
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
if ($regOutcome === 1) {
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
  $message = "<p>Thanks for registering $clientFirstname! Please use your email and password to login.</p>";
  include '../view/login.php';
  exit;
} else {
  $message = "<p>Sorry ".$clientFirstname.", but the registration failed. Please try again.</p>";
  include '../view/register.php';
  exit;
}
break;

//** ACTION: User logs in **//
case 'Login':
// Filter and store the data
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);

// Check for missing data
if(empty($clientEmail)){
  $message = '<p>Please provide valid information for username.</p>';
  include '../view/login.php';
  exit;
}
if(empty($checkPassword)){
  $message = '<p>Please provide valid password.</p>';
  include '../view/login.php';
  exit;
}      

// A valid password exists, proceed with the login process
 // Query the client data based on the email address
 $clientData = getClient($clientEmail);
 // Compare the password just submitted against
 // the hashed password for the matching client
 $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
 // If the hashes don't match create an error
 // and return to the login view
 if (!$hashCheck) {
  $message = '<p class="notice">Please check your password and try again.</p>';
  include '../view/login.php';
  exit; 
 }

 // A valid user exists, log them in
 $_SESSION['loggedin'] = TRUE;
 // Remove the password from the array
 // the array_pop function removes the last
 // element from an array
 array_pop($clientData);
 // Store the array into the session
 $_SESSION['clientData'] = $clientData;
 $clientFirstname = $_SESSION['clientData']['clientFirstname'];
 // Delete registration cookie
 setcookie('firstname', $clientFirstname, time() - 3600, '/');
 // Send them to the admin view
 include '../view/admin.php';
 exit; 
 break;

 //* ACTION: User logs out, serve home view *//
 case 'Logout':
 session_destroy();
 header("Location: ../index.php");
 exit;
 break;

 //* ACTION: Display account management panel *//

 case 'manageAccount':
 include '../view/account-management.php';
 exit; 
 break;

 //* ACTION: User updates account info *//
 case 'updateUserInfo':
  // Filter and store the data
  $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
  $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  
  // Check for missing data - provide error messages specific to missing data
  if(empty($clientFirstname)){
    $message = '<p>Please provide information for first name.</p>';
    include '../view/account-management.php';
    exit;
  }
  if(empty($clientLastname)){
    $message = '<p>Please provide information for last name.</p>';
    include '../view/account-management.php';
    exit;
  }
  if(empty($clientEmail)){
  $message = '<p>Please provide information for email address.</p>';
  include '../view/account-management.php';
  exit;
}

if($clientEmail != $_SESSION['clientData']['clientEmail']){
 // Verify that the email being registered is not already in the database
 $verifyEmail = verifyEmail($clientEmail);
 if($verifyEmail){
   $message = '<p class="notice">Sorry, that email address has already been used for another account.</p>';
   include '../view/account-management.php';
   exit;
  }else{
    $message = '<p class="notice">Email has been successfully changed.</p>';
    include '../view/account-management.php';}
}
if(empty($clientId)){
  $message = '<p>Sorry, user was not found.</p>';
  include '../view/account-management.php';
  exit;
}
   // Send the data to the model
   $updateUserResult = updateUser($clientFirstname, $clientLastname, $clientEmail, $clientId);

// Check and report the result
if($updateUserResult){
  //Include success message in session
  $message = "<p>Your account has been updated successfully, ".$clientFirstname.". </p>";
  $_SESSION['message'] = $message;
  //Update session data
  $clientData = getClient($clientEmail);
  array_pop($clientData);
  $_SESSION['clientData'] = $clientData;
  //Show view
  include '../view/account-management.php';
  exit;
} else {
  $message = "<p>Account update failed. No information was changed. Please try again.</p>";
  include '../view/account-management.php';
  exit;
}
 break;

 //** ACTION: Change password **//
 case 'updatePassword':
    // Filter and store data
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    //Verify new password meets requirements
     $checkPassword = checkPassword($clientPassword);
    //Check that field is not empty
     if(empty($checkPassword)){
       $message = '<p>Please provide valid information for password.</p>';
       include '../view/account-management.php';
       exit;
     }
     // Hash the checked password
     $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
     // Send the data to the model
     $updatePasswordResult = updatePassword($hashedPassword, $clientId);
     // Check and report the result
     if ($updatePasswordResult) {
       $message = "<p>Password change successful.</p>";
       include '../view/account-management.php';
  exit; } else {
  $message = "<p>Sorry, password change failed. Please try again.</p>";
  include '../view/account-management.php';
  exit;
}
 break;

 //* DEFAULT, show user admin panel *//
default:
include '../view/admin.php';
 }
?>