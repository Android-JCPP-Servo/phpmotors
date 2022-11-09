<?php
if(!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] == FALSE) {
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/phpmotors_css.css" media="screen" />
    <link rel="stylesheet" href="/phpmotors/css/table.css" media="screen" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300;400&display=swap" rel="stylesheet" />
    <title>Admin Account | PHP Motors</title>
</head>
<body>
    <div id="wrapper">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <!-- <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php'; ?> -->
            <?php echo $navList; ?>
        </nav>
        <main>
            <div class="row">
                <div class="col-10">
                    <h1><?php
                        if(isset($_SESSION['loggedin'])) {
                            echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname'];
                        } 
                    ?></h1>
                    <h2 class="management">You are logged in.</h2>
                    <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
                    <ul class="profile_list">
                        <li>First name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
                        <li>Last name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
                        <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
                    </ul>
                    <?php if(isset($_SESSION['loggedin'])) {
                        echo "<h2 class='management'>Account Management</h2>";
                        echo "<p>Use this link to update account information.</p>";
                        echo "<a href='/phpmotors/accounts/?action=update'>Update Account Information</a>";
                    } ?>
                    <?php if($_SESSION['clientData']['clientLevel'] > 2) {
                        echo "<h2 class='management'>Inventory Management</h2>";
                        echo "<p>Use this link to manage inventory.</p>";
                        echo "<a href='/phpmotors/vehicles/'>Vehicle Management</a>";
                    } ?>
                    <?php if(isset($_SESSION['loggedin'])) {
                        echo "<h2 class='management'>Manage Your Product Reviews</h2>";
                        // If there are any reviews, display them here with the Edit and Delete links.
                        // echo "<a href='/phpmotors/reviews/index.php?action=edit'>Edit</a>";
                        // echo " | ";
                        // echo "<a href='/phpmotors/reviews/index.php?action=delete'>Delete</a>";
                        // If not, display a specific message!
                        // echo "<p>You have not written any reviews!</p>";
                        if (isset($reviewList)) {
                            echo $reviewList;
                        } else {
                            if (isset($message)) {
                                echo $message;
                            }
                        }
                    } ?>
                </div>
            </div>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>