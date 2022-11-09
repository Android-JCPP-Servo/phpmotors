<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/phpmotors_css.css" media="screen" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300;400&display=swap" rel="stylesheet" />
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) { 
	    echo "$invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "$invMake $invModel"; }
    else { echo "Unknown"; }?> Details | PHP Motors</title>
</head>
<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "$invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) {
                echo "$invMake $invModel"; }
            else { echo "Unknown"; }?></h1>
            <?php if(isset($message)){echo $message;}?>
            <div class="row" id="vehicleDetails">
                <?php if(isset($detailDisplay)){echo $detailDisplay;}?>
            </div>
        </main>
        <hr>
        <h2>Customer Reviews</h2>
        <?php if(isset($_SESSION['loggedin']) && isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo '<h3>Review the '.$invInfo['invMake'].' '.$invInfo['invModel'].'</h3>';
            // echo "<p>You are logged in, and can write a review!</p>";
            // if(isset($rf)){echo $rf;}
            if(isset($alert)){echo $alert;}
            // // Build the form
            echo '<form action="/phpmotors/reviews/index.php" method="post">';
            echo '<fieldset>';
            echo '<legend>All Fields are Required</legend>';
            // // Add the input fields
            // echo '<label for="clientInitials">Client<br><input type="text" name="clientInitials" style="width: 20%;" value="'.substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname'].'" readonly></label>';
            // Display the remaining input fields
            require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/review.php';
            // Close the fieldset
            echo '</fieldset>';
            // Close the form
            echo '</form>';
        } else {
            echo "<p>You must <a href='/phpmotors/accounts/index.php?action=login'>login</a> to write a review.</p>";
        } ?>
        <?php 
        if(isset($reviewDisplay)){echo $reviewDisplay;}
        if(isset($invitation)){echo $invitation;}
        ?>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>