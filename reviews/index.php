<?php

/***********************
 * List of things to do
 ***********************/
// 1. Add a comment to indicate this is the reviews controller
/*
 * Vehicle Management Controller
 */

// 2. All controller components and processes must follow the typical patterns established in other controllers.
// Create or access a session
session_start();

// Use the database connection file
require_once '../library/connections.php';
// Use the phpmotors model
require_once '../model/main-model.php';
// Use the reviews model
require_once '../model/reviews-model.php';
// Get the functions handler
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// var_dump($classifications);
// exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);
// echo $navList;
// exit;

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}
// echo $action;

// 3. The needed processes are: 
//      - Add a new review 
//      - Deliver a view to edit a review. 
//      - Handle the review update. 
//      - Deliver a view to confirm deletion of a review. 
//      - Handle the review deletion. 
//      - A default that will deliver the "admin" view if the client is logged in or the php motors home view if not.
switch ($action) {
    case 'review':
        // Add a new review
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewDate = date('Y-m-d h:i:s', strtotime('now'));
        // echo $reviewDate;
        // exit;
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        // Check for missing data
        if (empty($reviewText)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            header('Location: /phpmotors/vehicles/?action=details&invId='.$invId);
            exit;
        }
        // Make sure review data is collected
        $reviewData = postReview($reviewText, $reviewDate, $invId, $clientId);
        if ($reviewData) {
            // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thank you for your review! It is displayed below.</p>";
            header('Location: /phpmotors/vehicles/?action=details&invId='.$invId);
            exit;
        } else {
            $message = "<p>Review insertion failed. Please try again.</p>";
            include '../view/vehicle-detail.php';
            exit;
        }
        break;
    case 'edit':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewByID($reviewId);
        // Make sure the review text gets saved, so it can be displayed should the user enter empty text
        $_SESSION['reviewInfo'] = $reviewInfo;
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no review information could be found.';
        }
        // Deliver a view to edit a review
        include '../view/review_edit.php';
        exit;
        break;
    case 'editReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewDate = date('Y-m-d h:i:s', strtotime('now'));
        // echo $reviewDate;
        // exit;
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        // echo $reviewId, ' ', $reviewText, ' ', $reviewDate, ' ', $invId, ' ', $clientId;
        // exit;
        if (empty($reviewText)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            // Display the original review text
            $reviewInfo = $_SESSION['reviewInfo'];
            include '../view/review_edit.php';
            exit;
        }
        $reviewResult = updateReview($reviewId, $reviewText, $reviewDate, $invId, $clientId);
        if ($reviewResult) {
            $message = "<p>Your review was updated successfully!</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "Your review was not updated. Please try again.</p>";
            include '../view/review_edit.php';
            exit;
        }
        break;
    case 'delete':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewByID($reviewId);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no review information could be found.';
        }
        // Deliver a view to confirm deletion of a review
        include '../view/review_delete.php';
        exit;
        break;
    case 'deleteReview':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING));
        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = '<p>The review was deleted successfully!</p>';
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "<p>Your review was not deleted. Please try again.</p>";
            include '../view/review_edit.php';
            exit;
        }
        break;
    default:
        // A default that will deliver the 'admin' view if the client is logged in or the php motors home view if not
        if(!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] == FALSE) {
            header('Location: /phpmotors/');
        } else {
            include '../view/admin.php';
        }
}
?>