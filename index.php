<?php

/*
* Acme Controller
*/

 // Create or access a Session 
 session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the functions library
require_once 'library/functions.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';

// Get the array of categories
$categories = getCategories();

// Test that function worked by uncommenting the following two lines
// var_dump($categories);
//	exit;

// Build a navigation bar using the $categories array
$navList = buildNav($categories);

// Test function
// echo $navList;
// exit;

// Display view based on action
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'home';
  }
 }

 // Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
 }

 switch ($action){
 case 'home':
  include 'view/home.php';
  break;
}

?>