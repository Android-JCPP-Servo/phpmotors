<?php

/*
 * Account Model Handler
 */

// Register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the php_motors connection
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

// Check for existing email address
function checkExistingEmail($clientEmail) {
    // Return connection to the database
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // Establish the clientEmail to the database value
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    // Execute statement
    $stmt->execute();
    // Fetch a single value to compare emails
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    // Close the database connection
    $stmt->closeCursor();
    // Begin email comparison
    if(empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

// Check for existing email address
function checkUpdatedEmail($clientEmail, $clientId) {
    // Return connection to the database
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail AND clientId <> :clientId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // Establish the clientEmail to the database value
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Execute statement
    $stmt->execute();
    // Fetch a single value to compare emails
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    // Close the database connection
    $stmt->closeCursor();
    // Begin email comparison
    if(empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail) {
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword
            FROM clients
            WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

// Function to update user profile information
function updateUser($clientId, $clientFirstname, $clientLastname, $clientEmail) {
    // Return connection to the database
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE clients 
            SET clientFirstname = :clientFirstname, 
                clientLastname = :clientLastname,
                clientEmail = :clientEmail
            WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Update Password
function updatePassword($clientId, $clientPassword) {
    // Return connection to the database
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE clients 
            SET clientPassword = :clientPassword
            WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
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

?>