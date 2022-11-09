<?php
if((!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] == FALSE) or isset($_SESSION['clientData'])) {
    $clientLevel = $_SESSION['clientData']['clientLevel'];
    if ($clientLevel < 2) {
        header('Location: /phpmotors/');
    }
}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/phpmotors_css.css" media="screen" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300;400&display=swap" rel="stylesheet" />
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) { 
	    echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
    <script>
        // Remaining character countdown
        // Referenced from: https://www.codexworld.com/live-character-counter-javascript/
        function countChars(obj){
            var maxLength = 200;
            var length = obj.value.length;
            var remaining = (maxLength - length);
            
            if (remaining > 0) {
                document.getElementById("remainingVehicle").innerHTML = '(' + remaining +' characters remaining)';
            } else {
                document.getElementById("remainingVehicle").innerHTML = '<span style="color: red;">(' + remaining + ` characters remaining)</span>`;
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
                <div class="col-12">
                    <h1><?php 
                    if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                        echo "Delete $invInfo[invMake] $invInfo[invModel]";
                    } elseif(isset($invMake) && isset($invModel)) {
                        echo "Delete $invMake $invModel";
                    }
                    ?></h1>
                    <p>Confirm Vehicle Deletion. The delete is permanent.</p>
                    <?php if (isset($message)) { echo $message; } ?>
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <fieldset>
                            <legend><h2>All Fields are Required</h2></legend>
                            <div class="row">
                                <div class="col-6">
                                    <label for="invMake">Make<br>
                                        <input type="text" name="invMake" id="invMake" <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> readonly>
                                    </label>
                                    <label for="invModel">Model<br>
                                        <input type="text" name="invModel" id="invModel" <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> readonly>
                                    </label>
                                    <label for="invDescription">Description
                                        <textarea name="invDescription" id="invDescription" rows="4" maxlength="200" onkeyup="countChars(this);" readonly><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="add_value" value="Delete Vehicle">
                                    <input type="hidden" name="action" value="deleteVehicle">
                                    <input type="hidden" name="invId" value="
                                    <?php if(isset($invInfo['invId'])){echo $invInfo['invId'];}
                                    elseif(isset($invId)){echo $invId;}?>
                                    ">
                                </div>
                            </div>
                        </fieldset>
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