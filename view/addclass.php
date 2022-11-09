<?php
if((!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] == FALSE) or isset($_SESSION['clientData'])) {
    $clientLevel = $_SESSION['clientData']['clientLevel'];
    if ($clientLevel < 2) {
        header('Location: /phpmotors/');
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/phpmotors_css.css" media="screen" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300;400&display=swap" rel="stylesheet" />
    <title>Add Car Classification | PHP Motors</title>
    <script>
        // Remaining character countdown
        // Referenced from: https://www.codexworld.com/live-character-counter-javascript/
        function countChars(obj){
            var maxLength = 200;
            var length = obj.value.length;
            var remaining = (maxLength - length);
            
            if (remaining > 0) {
                document.getElementById("remaining").innerHTML = '(' + remaining +' characters remaining)';
            } else {
                document.getElementById("remaining").innerHTML = '<span style="color: red;">(' + remaining + ` characters remaining)</span>`;
            }
        }
    </script>
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
                <div class="col-4">
                    <h1>Add Car Classification</h1>
                    <?php if (isset($message)) { echo $message; } ?>
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <label for="classificationName">Classification Name
                            <input type="text" name="classificationName" id="classificationName" maxlength="30"  onkeyup="countChars(this);" <?php if(isset($classificationName)){echo "value='$classificationName'";} ?> required>
                            <span id="remaining">(30 characters remaining)</span>
                        </label>
                        <input type="submit" name="submit" class="add_value" value="Add Classification">
                        <input type="hidden" name="action" value="addClass">
                    </form>
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