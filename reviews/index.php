<?php
/*
* Reviews Controller
*/

 // Create or access a Session 
 session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';

// Get the array of categories 
$categories = getCategories();

// Build a navigation bar using the $categories array
$navList = buildNav($categories);

// Display view based on action
$action = filter_input(INPUT_POST, 'action');

 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'default';
  }
 }

 switch ($action) {

case 'addReview':
    //Get inventory id and filter
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    //Send invId variable to function in Product Model to get information on product from database
    if(empty($invId)){
      $message = '<p>Sorry, product could not be found for review.</p>';
      $_SESSION['message'] = $message;
      header("Location: ../index.php");
      exit;
    }
    $prodInfo = getProductInfo($invId);
    //Display view to add review
    include '../view/add-review.php';
    break;

case 'submitReview':
// Add a new review
 // Filter and store the data
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
 $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
 $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
 // Check for missing data - provide error messages specific to missing data
if(empty($invId)){
    header("Location: ../accounts/index.php");
    $message = '<p>Sorry, product could not be found for review.</p>';
    $_SESSION['message'] = $message;
    exit;
  }
  if(empty($clientId)){
    header("Location: ../accounts/index.php?action=login");
    $message = '<p>Sorry, you need to log in before you can review.</p>';
    $_SESSION['message'] = $message;
    exit;
  }
  if(empty($reviewText)){
    header("Location: ../reviews/?action=addReview&invId=".$invId);
    $message = '<p>Please provide content for your review.</p>';
    $_SESSION['message'] = $message;
    exit;
  }
  
// Send the data to the model
$reviewOutcome = addReview($reviewText, $invId, $clientId);

// Check and report the result
if($reviewOutcome === 1){
  header("Location: ../products/?action=viewProduct&id=".$invId);
  $message = "<p>Review has been posted successfully.</p>";
  $_SESSION['message'] = $message;
  exit;
} else {
  header("Location: ../products/?action=viewProduct&id=".$invId);
  $_SESSION['message'] = "<p>Posting review failed. Please try again.</p>";
  exit;
}
break;

case 'editReview':
  // Deliver a view to edit a review.
  //Get review id and filter
  $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

  //Get review info from functions.
  $reviewInfo = getReviewsById($reviewId);
  $userId = $reviewInfo[0]['clientId'];
  $productId = $reviewInfo[0]['invId'];
  $prodName = getProductByReview($productId);
  $clientName = getUserFirstName($userId);

  //Check to see if variable returned review data successfully. If not, display error
    if(count($reviewInfo)<1){
    $message = 'Sorry, that review could be found.';
    $_SESSION['message'] = $message;
  }

  //Display view to update data
  include '../view/review-update.php';
  exit;
   break; 

case 'updateReview':
   // Handle the review update.
   // Filter and store data
   $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
   $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
   $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

   //Get review info from functions
   $reviewInfo = getReviewsById($reviewId);
   $userId = $reviewInfo[0]['clientId'];
   $productId = $reviewInfo[0]['invId'];
   $prodName = getProductByReview($productId);
   $clientName = getUserFirstName($userId);

   if(empty($reviewId)){
    $message = '<p>Sorry, review could not be found.</p>';
    include '../view/review-update.php';
    exit;
  }
  if($clientId != $userId){
    $message = '<p>Sorry, it looks like this review was not written by you. If you think there has been an error, please
    contact an admin.</p>';
    include '../view/review-update.php';
    exit;
  }
  if(empty($reviewText)){
    $message = '<p>Please add content to your review. If you wish to delete your review, please click <a href="?action=confirmDelete&id='.$reviewId.'">here.</a></p>';
    include '../view/review-update.php';
    exit;
  }

   // Send the data to the model
   $updateResult = updateReview($reviewId, $reviewText);

   // Check and report the result
if($updateResult){
  //Include success message in session and redirect back to products page
  $message = "<p>Review has been updated successfully.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/reviews/');
  exit;
} else {
  $message = "<p>Review update failed. No information was changed. Please try again.</p>";
  include '../view/review-update.php';
  exit;
}
    break; 

case 'confirmDelete':
    // Deliver a view to confirm deletion of a review.
    //Get review id and filter
    $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    //Send reviewId variable to function in model to get information on product from database
    $reviewInfo = getReviewsById($reviewId);
    //Check to see if reviewInfo variable returned review data successfully. If not, display error
    if(count($reviewInfo)<1){
      $message = 'Sorry, that review could not be found.';
      $_SESSION['message'] = $message;}
      
      $userId = $reviewInfo[0]['clientId'];
      $productId = $reviewInfo[0]['invId'];
      $prodName = getProductByReview($productId);
      $clientName = getUserFirstName($userId);

    //Display view to update data
    include '../view/review-delete.php';
    exit;
    break; 

    case 'deleteReview':
    //Handle review deletion
     // Filter and store data
     $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
     $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
     
  //Get review info from functions
  $reviewInfo = getReviewsById($reviewId);
  $userId = $reviewInfo[0]['clientId'];
  $productId = $reviewInfo[0]['invId'];
  $prodName = getProductByReview($productId);
  $clientName = getUserFirstName($userId);

   if(empty($reviewId)){
    $message = '<p>Sorry, review could not be found.</p>';
    include '../view/review-delete.php';
    exit;
  }
  if($clientId != $userId){
    $message = '<p>Sorry, it looks like this review was not written by you. If you think there has been an error, please
    contact an admin.</p>';
    include '../view/review-delete.php';
    exit;
  } 
   // Send the data to the model
   $deleteResult = deleteReview($reviewId);

// Check and report the result
if($deleteResult){
  //Include success message in session and redirect back to products page
  $message = "<p>Review has been deleted successfully.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/reviews/');
  exit;
} else {
  $message = "<p>Review delete failed. Please try again.</p>";
  include '../view/review-delete.php';
  exit;
}
    break; 

default:
  $clientId = $_SESSION['clientData']['clientId'];
  $databaseCount = countReviews($clientId);
  $reviews = getReviewsByClient($clientId);
  include '../view/reviews.php';
 }
 ?>