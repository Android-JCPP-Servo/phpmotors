<?php
if((!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] == FALSE) or isset($_SESSION['clientData'])) {
    $clientLevel = $_SESSION['clientData']['clientLevel'];
    if ($clientLevel < 2) {
        header('Location: /phpmotors/');
    }
}
$classificationList = '<select id="classificationId" name="classificationId">';
$classificationList .= "<option>Choose Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        }
    } elseif(isset($invInfo['classificationId'])) {
        // add an additional test using an elseif to 
        // check for the $invInfo array and then check
        // if its classificationId value matches the
        // value from the original car classifications query
        if($classification['classificationId'] === $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) { 
	    echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
            <?php echo $navList; ?>
        </nav>
        <main>
            <div class="row">
                <div class="col-12">
                    <h1><?php 
                    if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                        echo "Modify $invInfo[invMake] $invInfo[invModel]";
                    } elseif(isset($invMake) && isset($invModel)) {
                        echo "Modify $invMake $invModel";
                    }
                    ?></h1>
                    <?php if (isset($message)) { echo $message; } ?>
                    <form action="/phpmotors/vehicles/index.php" method="post">
                        <fieldset>
                            <legend><h2>All Fields are Required</h2></legend>
                            <div class="row">
                                <div class="col-6">
                                    <label>Classification
                                        <?php echo $classificationList; ?>
                                    </label>
                                    <label for="invMake">Make<br>
                                        <input type="text" name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } elseif(isset($invMake)){ echo "value='$invMake'"; }?> required>
                                    </label>
                                    <label for="invModel">Model<br>
                                        <input type="text" name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } elseif(isset($invModel)){ echo "value='$invModel'"; }?> required>
                                    </label>
                                    <label for="invDescription">Description <span id="remainingVehicle">(200 characters remaining)</span>
                                        <textarea name="invDescription" id="invDescription" rows="4" maxlength="200" onkeyup="countChars(this);" required><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } elseif(isset($invDescription)){echo $invDescription;}?></textarea>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label for="invImage">Image URL<br>
                                        <input type="text" name="invImage" id="invImage" <?php if(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } elseif(isset($invImage)){echo "value='$invImage'";}?> required>
                                    </label>
                                    <label for="invThumbnail">Thumbnail URL<br>
                                        <input type="text" name="invThumbnail" id="invThumbnail" <?php if(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } elseif(isset($invThumbnail)){echo "value='$invThumbnail'";}?> required>
                                    </label>
                                    <label for="invPrice">Price<br>
                                        <input type="number" name="invPrice" id="invPrice" step="1" <?php if(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } elseif(isset($invPrice)){echo "value='$invPrice'";}?> required>
                                    </label>
                                    <label for="invStock"># In-Stock<br>
                                        <input type="number" name="invStock" id="invStock" step="1" <?php if(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } elseif(isset($invStock)){echo "value='$invStock'";}?> required>
                                    </label>
                                    <label for="invColor">Color<br>
                                        <input type="text" name="invColor" id="invColor" <?php if(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } elseif(isset($invColor)){echo "value='$invColor'";}?> required>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="add_value" value="Update Vehicle">
                                    <input type="hidden" name="action" value="updateVehicle">
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
<?php unset($_SESSION['message']); ?>