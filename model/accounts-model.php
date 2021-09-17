<?php

/*
* Accounts Model for site visitors
*/

/*  Site Registrations function */

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    // Create a connection object using the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
   }


     /*  Update User function */
     function updateUser($clientFirstname, $clientLastname, $clientEmail, $clientId){
        // Create a connection object using the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, 
        clientEmail = :clientEmail WHERE clientId = :clientId'; 
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // Replace the placeholders in the SQL statement with the actual values in the variables and tell the database the type of data it is
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
        // Update the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
       }

       /*  Update Password */
     function updatePassword($hashedPassword, $clientId){
        // Create a connection object using the acme connection function
        $db = acmeConnect();
        // The SQL statement
        $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId'; 
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // Replace the placeholders in the SQL statement with the actual values in the variables and tell the database the type of data it is
        $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
        // Update the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
       }

?>