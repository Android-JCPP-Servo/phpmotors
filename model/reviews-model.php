<?php 

/*
 * Review Model Handler
 */

// Function to pass review into database
function postReview($reviewText, $reviewDate, $invId, $clientId) {
    // Ensure database connection
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId)
            VALUES (:reviewText, :reviewDate, :invId, :clientId)';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
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

// Function to get all reviews associated with selected vehicle
function getAllReviews($invId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews r INNER JOIN clients c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY r.reviewDate DESC';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Select the data
    $stmt->execute();
    // Fetch associated data related to the statement
    $revInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database transaction
    $stmt->closeCursor();
    // Return the result
    return $revInfo;
}

// Function to call all reviews based on logged in user
function getUserReviews($clientId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM clients c INNER JOIN reviews r ON c.clientId = r.clientId INNER JOIN inventory i ON i.invId = r.invId WHERE c.clientId = :clientId ORDER BY reviewDate DESC';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Select the data
    $stmt->execute();
    // Fetch associated data related to the statement
    $clientReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Close the database transaction
    $stmt->closeCursor();
    // Return the result
    return $clientReviews;
}

// Function to get specific review by ID
function getReviewByID($reviewId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews r INNER JOIN inventory i ON r.invId = i.invId WHERE reviewId = :reviewId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // The next line replaces the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Select the data
    $stmt->execute();
    // Fetch associated data related to the statement
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    // Close the database transaction
    $stmt->closeCursor();
    // Return the result
    return $invInfo;
}

// Function to modify selected review
function updateReview($reviewId, $reviewText, $reviewDate, $invId, $clientId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE reviews 
            SET reviewId = :reviewId,
                reviewText = :reviewText,
                reviewDate = :reviewDate,
                invId = :invId,
                clientId = :clientId
            WHERE reviewId = :reviewId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // These next lines replace the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
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

// Function to delete the selected review
function deleteReview($reviewId) {
    // Connect to the database controller
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the php_motors connection
    $stmt = $db->prepare($sql);
    // These next lines replace the placeholders in the SQL 
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
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