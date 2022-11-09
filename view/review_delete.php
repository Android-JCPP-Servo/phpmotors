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
    <title>Delete Review | PHP Motors</title>
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
            <h1>Delete <?php if(isset($reviewInfo['invMake']) && isset($reviewInfo['invModel'])) {echo "$reviewInfo[invMake] $reviewInfo[invModel]"; }?> Review</h1>
            <h2>Reviewed on <?php if(isset($reviewDate)){echo $reviewDate;} elseif(isset($reviewInfo['reviewDate'])) {echo $reviewInfo['reviewDate']; }?></h2>
            <p style="color: #BD0000;">Deletes cannot be undone. Are you sure you want to delete this review?</p>
            <?php if(isset($message)){echo $message;} ?>
            <form action="/phpmotors/reviews/index.php" method="post">
                <fieldset>
                    <legend>All Fields are Required</legend>
                    <label for="reviewText"><strong>Review Text</strong>
                        <textarea class="reviewText" name="reviewText" id="reviewText" rows="4" readonly><?php if(isset($reviewText)){echo $reviewText;} elseif(isset($reviewInfo['reviewText'])) {echo $reviewInfo['reviewText']; }?></textarea>
                    </label>
                    <input type="submit" name="submit" class="review" value="Delete Review">
                    <input type="hidden" name="action" value="deleteReview">
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