<?php
/*
 * Email Validation Handler
 */
function checkEmail($clientEmail) {
    $validEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $validEmail;
}
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}
function buildNavigation($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}
// Build the classifications select list
function buildClassificationList($classifications) {
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= "</select>";
    return $classificationList;
}
// Build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a class='linkDiv' href='/phpmotors/vehicles/?action=details&invId=".urlencode($vehicle['invId'])."'>";
        $dv .= "<div class='bottomDiv'>";
            $dv .= "<img src='$vehicle[invThumbnail]' alt='$vehicle[invColor] $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= "</div>";
        $dv .= '<hr style="width: 100%;">';
        $dv .= "<h2 style='height: 50px;'>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= '<span>$'.number_format("$vehicle[invPrice]").'</span>';
        $dv .= "</a>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}
// Function to build Vehicle Detail display
function buildDetailDisplay($invInfo) {
    // Column 1
    $dv = '<div class="col-6">';
        $dv .= "<img src='$invInfo[invImage]' alt='$invInfo[invColor] $invInfo[invMake] $invInfo[invModel]' style='width: 100%;'>";
        $dv .= '<h2>Price: $'.number_format("$invInfo[invPrice]").'</h2>';
    $dv .= '</div>';
    // Column 2
    $dv .= '<div class="col-6">';
        $dv .= '<h3>'."$invInfo[invMake]".' '."$invInfo[invModel]".' Details</h3>';
        $dv .= '<div style="padding: 10px; background-color: #bababa;">'."$invInfo[invDescription]".'</div>';
        $dv .= '<div style="padding: 10px; background-color: #fff;">Color: '."$invInfo[invColor]".'</div>';
        $dv .= '<div style="padding: 10px; background-color: #bababa;"># in Stock: '."$invInfo[invStock]".'</div>';
    $dv .= '</div>';
    return $dv;
}
// Function to build the review display
function buildReviewDisplay($revInfo) {
    $dv = '<div class="row">';
    foreach ($revInfo as $review) {
        $dv .= '<div class="col-12" style="background-color: #F98E42">';
            $dv .= '<h2>'.substr("$review[clientFirstname]", 0, 1)."$review[clientLastname]".' wrote on '."$review[reviewDate]".'</h2>';
            $dv .= '<p>'."$review[reviewText]".'</p>';
        $dv .= '</div>';
    }
    $dv .= '</div>';
    return $dv;
}
// Function to display all reviews from the logged in user
function listUserReviews($clientReviews) {
    $dv = "";
    foreach ($clientReviews as $clientReview) {
        $dv .= "<div class='row' style='padding: 10px 0;'>";
        // echo "$clientReview[reviewId]".' ';
        $dv .= '<div class="col-4"><strong>'."$clientReview[invMake]".' '."$clientReview[invModel]".'</strong></div>';
        // $dv .= ' ';
        // $dv .= '<td>'."$clientReview[invModel]".'</td>';
        $dv .= '<div class="col-6">(Reviewed on '."$clientReview[reviewDate]".')</div>';
        $dv .= '<div class="col-1"><a href="/phpmotors/reviews/index.php?action=edit&reviewId='."$clientReview[reviewId]".'">Edit</a></div>';
        // $dv .= '&emsp;|&emsp;';
        $dv .= '<div class="col-1"><a href="/phpmotors/reviews/index.php?action=delete&reviewId='."$clientReview[reviewId]".'">Delete</a></div>';
        // echo "$clientReview[reviewId]".' ';
        $dv .= '</div>';
    }
    return $dv;
}
?>