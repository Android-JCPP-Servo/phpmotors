<?php
/*
 * Vehicle Management Controller
 */

// Create or access a session
session_start();

// Use the database connection file.
require_once '../library/connections.php';
// Use the phpmotors model.
require_once '../model/main-model.php';
// Use the vehicles model
require_once '../model/vehicle-model.php';
// Use the vehicles model
require_once '../model/reviews-model.php';
// Get the functions handler
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// var_dump($classifications);
// echo json_encode($classifications);
// exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

// Create a $classificationList variable to build a dynamic drop-down select list.
// $classificationList = '<select id="classificationId" name="classificationId">';
// $classificationList .= "<option value='' selected disabled>Choose Car Classification</option>";

// foreach ($classifications as $classification) {
//     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
// }

// $classificationList .= '</select>';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'class':
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/addclass.php';
        exit;
    case 'addClass':
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));
        if (empty($classificationName)) {
            $message = "<p>Please enter a classification name</p>";
            include '../view/addclass.php';
            exit;
        }
        $classOutcome = addClassification($classificationName);
        if ($classOutcome === 1) {
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p>Vehicle classification was not added. Please try again.</p>";
            include '../view/addclass.php';
            exit;
        }
        break;
    case 'vehicle':
        include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/addvehicle.php';
        exit;
    case 'addVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            include '../view/addvehicle.php';
            exit;
        }
        $vehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
        if ($vehicleOutcome === 1) {
            $message = "<p>The $invMake $invModel has been added!</p>";
            include '../view/addvehicle.php';
            exit;
        } else {
            $message = "<p>The vehicle was not added. Please try again.</p>";
            include '../view/addvehicle.php';
            exit;
        }
        break;
    case 'getInventoryItems':
        // Get the classificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the database
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        // Capture the value of the second name - value pair
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        // Send the variable into a function that will get the information for that single vehicle
        $invInfo = getInvItemInfo($invId);
        // Make sure the invInfo is saved, so it will be displayed if any empty fields are present
        $_SESSION['invInfo'] = $invInfo;
        // Check to see if $invInfo has any data.
        // If not, we will set an error message
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        // Finally, call a view where the data can be displayed,
        // so changes can be made to the data
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="center">Please provide information for all empty form fields.</p>';
            $invInfo = $_SESSION['invInfo'];
            include '../view/vehicle-update.php';
            exit;
        }
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updateResult) {
            $message = "<p>The $invMake $invModel has been updated!</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>The vehicle was not updated. Please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        // Capture the value of the second name - value pair
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        // Send the variable into a function that will get the information for that single vehicle
        $invInfo = getInvItemInfo($invId);
        // Check to see if $invInfo has any data.
        // If not, we will set an error message
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        // Finally, call a view where the data can be displayed,
        // so changes can be made to the data
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p>The $invMake $invModel has been deleted!</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Error: The $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        // echo $vehicleDisplay;
        // exit;
        include '../view/classification.php';
        break;
    case 'details':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        // echo $invId;
        // exit;
        $invInfo = getInvItemInfo($invId);
        // echo $revInfo;
        // exit;
        if(!$invInfo) {
            $message = "<p>Vehicle details could not be retrieved.</p>";
        } else {
            $detailDisplay = buildDetailDisplay($invInfo);
        }
        // Get all reviews belonging to selected car
        $revInfo = getAllReviews($invId);
        // console.log($revInfo);
        // print_r($revInfo);
        // exit;
        // Then check vehicle reviews
        if (!$revInfo) {
            $invitation = "<p>Be the first to review this vehicle!</p>";
        } else {
            // echo "<p>Here's a review!</p>";
            $alert = "<p>Thank you for your review! It is displayed below.</p>";
            $reviewDisplay = buildReviewDisplay($revInfo);
        }
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        if((!isset($_SESSION['loggedin']) or $_SESSION['loggedin']) == FALSE and $_SESSION['clientData']['clientLevel'] < 2) {
            header('Location: /phpmotors/');
        } else {
            include '../view/vehicle_man.php';
        }
}
?>