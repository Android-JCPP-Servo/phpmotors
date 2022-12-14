<?php

/*
 * Vehicle Model Handler
 */

// Contain a function for inserting a new classification to the carclassifications table.
function addClassification($classificationName) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Contain a function for inserting a new vehicle to the inventory table.
function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) 
    VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // These next lines replace the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Contain a function for updating a new vehicle to the inventory table.
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // These next lines replace the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Contain a function for deleting a new vehicle to the inventory table.
function deleteVehicle($invId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // These next lines replace the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId
function getInventoryByClassification($classificationId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = "SELECT * FROM inventory WHERE classificationId = :classificationId";
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Fetch all associated data related to the statement
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database transaction
    $stmt->closeCursor();
    // Return the result
    return $inventory;
}

// Get vehicle information by invId
function getInvItemInfo($invId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Select the data
    $stmt->execute();
    // Fetch associated data related to the statement
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close the database transaction
    $stmt->closeCursor();
    // Return the result
    return $invInfo;
}

// Get a list of vehicles based on classification
function getVehiclesByClassification($classificationName) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

?>