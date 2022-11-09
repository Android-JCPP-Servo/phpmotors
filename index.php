<?php

/*
 * Main Controller
 */

// Create or access a session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions handler
require_once 'library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// var_dump($classifications);
// exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);
// echo $navList;
// exit;

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

// Check if the firstname cookie exists and get its value
if(isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default:
        include 'view/home.php';
}
?>