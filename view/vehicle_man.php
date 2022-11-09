<?php
if((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == FALSE) || isset($_SESSION['clientData'])) {
    $clientLevel = $_SESSION['clientData']['clientLevel'];
    if ($clientLevel < 2) {
        header('Location: /phpmotors/');
        exit;
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
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
    <title>Account Registration | PHP Motors</title>
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
                <div class="col-6">
                    <h1>Vehicle Management</h1>
                    <ul class="list">
                        <li><a href="/phpmotors/vehicles/index.php?action=class" id="classification-link">Add Classification</a></li>
                        <li><a href="/phpmotors/vehicles/index.php?action=vehicle" id="addvehicle-link">Add Vehicle</a></li>
                    </ul>
                    <?php 
                    if (isset($message)) {
                        echo $message;
                    }
                    if (isset($classificationList)) {
                        echo '<h2>Vehicles by Classification</h2>';
                        echo '<p>Choose a classification to see those vehicles.</p>';
                        echo $classificationList;
                    }
                    ?>
                    <noscript>
                        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                    </noscript>
                    <table id="inventoryDisplay" class="inventoryTable"></table>
                </div>
            </div>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>