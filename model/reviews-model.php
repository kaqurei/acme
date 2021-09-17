<?php

/*
* Reviews Model
*/

// Insert a review function
function addReview($reviewText, $invId, $clientId){
  // Create a connection object using the acme connection function
  $db = acmeConnect();
  // The SQL statement
  $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
      VALUES (:reviewText, :invId, :clientId)';
  // Create the prepared statement using the acme connection
  $stmt = $db->prepare($sql);
  // Tells the database the type of data it is
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  // Insert the data
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
 }

// Get reviews by invId
function getReviewsByInvId($invId){ 
  $db = acmeConnect(); 
  $sql = ' SELECT * FROM reviews WHERE invId = :invId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $reviews; 
 }

// Get reviews by client
function getReviewsByClient($clientId){ 
  $db = acmeConnect(); 
  $sql = ' SELECT * FROM reviews WHERE clientId = :clientId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $reviews; 
 }

  // Count reviews in database by clientId 
  function countReviews($clientId){ 
  $db = acmeConnect(); 
  $sql = ' SELECT reviewText FROM reviews WHERE clientId = :clientId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor(); 
  return $rowsChanged; 
  }

// Get a review by Id
function getReviewsById($reviewId){ 
  $db = acmeConnect(); 
  $sql = ' SELECT * FROM reviews WHERE reviewId = :reviewId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $reviews; 
 }

// Update a specific review function
function updateReview($reviewId, $reviewText){
   // Create a connection object using the acme connection function
   $db = acmeConnect();
   // The SQL statement
   $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId'; 
   // Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
   // Replace the placeholders in the SQL statement with the actual values in the variables and tell the database the type of data it is
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
   // Update the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
  }

// Delete a specific review function
function deleteReview($reviewId){
  // Create a connection object using the acme connection function
  $db = acmeConnect();
  // The SQL statement
  $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';  
  // Create the prepared statement using the acme connection
  $stmt = $db->prepare($sql);
  // Replace the placeholder in the SQL statement with the actual value in the variable and tell the database the type of data it is
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
  // Delete the record
  $stmt->execute();
  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  // Close the database interaction
  $stmt->closeCursor();
  // Return the indication of success (rows changed)
  return $rowsChanged;
 }

?>