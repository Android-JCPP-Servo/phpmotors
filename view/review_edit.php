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
    <title>Update Review | PHP Motors</title>
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
            <h1><?php if(isset($reviewInfo['invMake']) && isset($reviewInfo['invModel'])) {echo "$reviewInfo[invMake] $reviewInfo[invModel]"; }?></h1>
            <h2>Reviewed on <?php if(isset($reviewInfo['reviewDate'])) {echo $reviewInfo['reviewDate']; } elseif(isset($reviewDate)){echo $reviewDate;}?></h2>
            <?php if(isset($message)){echo $message;} ?>
            <form action="/phpmotors/reviews/index.php" method="post">
                <fieldset>
                    <legend>All Fields are Required</legend>
                    <label for="reviewText"><strong>Review Text</strong>
                        <textarea class="reviewText" name="reviewText" id="reviewText" rows="4" required><?php if(isset($reviewInfo['reviewText'])) {echo $reviewInfo['reviewText']; } elseif(isset($reviewText)){echo $reviewText;}?></textarea>
                    </label>
                    <input type="submit" name="submit" class="review" value="Update Review">
                    <input type="hidden" name="action" value="editReview">
                    <input type="hidden" name="reviewId" value="'.<?php if(isset($reviewInfo['reviewId'])){echo $reviewInfo['reviewId'];} elseif(isset($reviewId)){echo $reviewId;}?>.'">
                    <input type="hidden" name="clientId" value="'.<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];} elseif(isset($clientId)){echo $clientId;}?>.'">
                    <input type="hidden" name="invId" value="'.<?php if(isset($reviewInfo['invId'])){echo $reviewInfo['invId'];} elseif(isset($invId)){echo $invId;}?>.'">
                </fieldset>
            </form>
        </main>
        <hr>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>