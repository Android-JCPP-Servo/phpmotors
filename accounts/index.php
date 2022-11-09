<?php
/*
 * Accounts Controller
 */

// Create or access a session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the reviews model
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

switch ($action) {
    case 'admin':
        // Get the client ID from the session
        $clientId = $_SESSION['clientData']['clientId'];
        // echo $clientId;
        // exit;
        // Get all reviews written by that user
        $clientReviews = getUserReviews($clientId);
        // If there are reviews returned,...
        if ($clientReviews) {
            $reviewList = listUserReviews($clientReviews);
        } else {
            $message = "<p>You have not written any reviews yet!</p>";
        }
        include '../view/admin.php';
        break;
    case 'login':
        include '../view/login.php';
        break;
    case 'Login':
        // Filter and store the data
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        // Thoroughly filter email and password
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match, create an error
        // message and return to the log in page
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in!
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // The array_pop function removes the
        // last element from the array.
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        // Get the client ID from the session
        $clientId = $_SESSION['clientData']['clientId'];
        // echo $clientId;
        // exit;
        // Get all reviews written by that user
        $clientReviews = getUserReviews($clientId);
        // If there are reviews returned,...
        if ($clientReviews) {
            $reviewList = listUserReviews($clientReviews);
        } else {
            $message = "<p>You have not written any reviews yet!</p>";
        }
        include '../view/admin.php';
        exit;
        break;
    case 'logout':
        include '../view/logout.php';
        break;
    case 'create':
        include '../view/register.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        // Thoroughly filter email and password
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email
        $existingEmail = checkExistingEmail($clientEmail);
        // Deal with existing email during registration
        if ($existingEmail) {
            $_SESSION['message'] = '<p>The email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p class="center">Please provide information for all empty form fields.</p>';
            include '../view/register.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model if no errors exist
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        // Check and report the result
        if ($regOutcome === 1) {
            // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry, $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }
        // Get the client ID from the session
        $clientId = $_SESSION['clientData']['clientId'];
        // echo $clientId;
        // exit;
        // Get all reviews written by that user
        $clientReviews = getUserReviews($clientId);
        // If there are reviews returned,...
        if ($clientReviews) {
            $reviewList = listUserReviews($clientReviews);
        } else {
            $message = "<p>You have not written any reviews yet!</p>";
        }
        break;
    case 'update':
        include '../view/account-update.php';
        break;
    case 'updateAccount':
        // Filter and store the data
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

        // echo "$clientId, $clientFirstname, $clientLastname, $clientEmail";
        // Thoroughly filter email and password
        $clientEmail = checkEmail($clientEmail);
        // Check for existing email
        $existingEmail = checkUpdatedEmail($clientEmail, $clientId);
        // Deal with existing email during account update
        if ($existingEmail) {
            $_SESSION['message'] = '<p>The email address already exists. Please provide a different email address.</p>';
            include '../view/account-update.php';
            exit;
        } else {
            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                $_SESSION['message'] = '<p class="center">Please provide information for all empty form fields.</p>';
                $clientFirstname = $_SESSION['clientData']['clientFirstname'];
                $clientLastname = $_SESSION['clientData']['clientLastname'];
                $clientEmail = $_SESSION['clientData']['clientEmail'];
                include '../view/account-update.php';
                exit;
            }
            
            // Update User profile
            $updatedUser = updateUser($clientId, $clientFirstname, $clientLastname, $clientEmail);
            if ($updatedUser) {
                // Display updated profile message
                $_SESSION['message'] = "<p>Thank you, $clientFirstname. Your profile has been updated.</p>";
                // Display updated profile information
                $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
                $_SESSION['clientData']['clientLastname'] = $clientLastname;
                $_SESSION['clientData']['clientEmail'] = $clientEmail;
                // Rewrite the session
                session_write_close();
                // Send the user back to the Accounts Admin page
                header('Location: /phpmotors/accounts/');
                // Stop all other code execution
                exit;
            } else {
                // Display error message
                $_SESSION['message'] = "<p>Sorry, we could not update your account information. Please try again.</p>";
                // Relocate to the Account Update page
                include '../view/account-update.php';
                // Stop all other code execution
                exit;
            }
        }
        break;
    case 'updatePassword':
        // Filter and store the data
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        // Thoroughly filter email and password
        $checkPassword = checkPassword($clientPassword);
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Check for missing data
        if (empty($clientPassword)) {
            $_SESSION['message'] = '<p class="center">Please provide a valid password.</p>';
            include '../view/account-update.php';
            exit;
        }
        if (!$checkPassword) {
            $_SESSION['message'] = '<p class="center">Please match the requested format.</p>';
            include '../view/account-update.php';
            exit;
        } else {
            $updatedPassword = updatePassword($clientId, $hashedPassword);
            // echo "$updatedPassword";
            if ($updatedPassword) {
                // Display updated profile message
                $_SESSION['message'] = "<p>Thank you, ". $_SESSION['clientData']['clientFirstname']. ". Your password has been updated.</p>";
                $_SESSION['clientData']['clientPassword'] = $clientPassword;
                // Rewrite the session
                session_write_close();
                // Send the user back to the Accounts Admin page
                header('Location: /phpmotors/accounts/');
                // Stop all other code execution
                exit;
            } else {
                $_SESSION['message'] = "<p style='color: red'>Password was not changed. Please enter a new password.</p>";
                include '../view/account-update.php';
                exit;
            }
        }
        break;
    default:
        include '../view/login.php';
}
?>