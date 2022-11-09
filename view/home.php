<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/phpmotors_css.css" media="screen" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300;400&display=swap" rel="stylesheet" />
    <title>Home | PHP Motors</title>
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
            <h1>Welcome to PHP Motors!</h1>
            <div id="main_car">
                <img src="./images/vehicles/delorean.jpg" alt="DeLorean Model Car" id="delorean">
                <div id="own_now">
                    <p id="delorean_text">
                        <b>DMC DeLorean</b><br>
                        3 Cup holders<br>
                        Superman doors<br>
                        Fuzzy dice!<br>
                    </p>
                    <img src="./images/site/own_today.png" alt="Own Today Button" id="own_today">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h2 class="subtitles">Delorean Upgrades</h2>
                    <div class="row">
                        <div class="col-6 align_center">
                            <div class="row blue_background">
                                <img src="./images/upgrades/flux-cap.png" alt="Flux Cap" class="upgrade">
                            </div>
                            <div class="row">
                                <a href="#" class="image_text">Flux Cap</a>
                            </div>
                        </div>
                        <div class="col-6 align_center">
                            <div class="row blue_background">
                                <img src="./images/upgrades/flame.jpg" alt="Flame" class="upgrade">
                            </div>
                            <div class="row">
                                <a href="#" class="image_text">Flame</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 align_center">
                            <div class="row blue_background">
                                <img src="./images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker" class="upgrade">
                            </div>
                            <div class="row">
                                <a href="#" class="image_text">Bumper Sticker</a>
                            </div>
                        </div>
                        <div class="col-6 align_center">
                            <div class="row blue_background">
                                <img src="./images/upgrades/hub-cap.jpg" alt="Hub Cap" class="upgrade">
                            </div>
                            <div class="row">
                                <a href="#" class="image_text">Hub Cap</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">                 
                    <h2 class="subtitles">DMC DeLorean Reviews</h2>
                    <div class="row">
                        <ol>
                            <li class="reviews">"So fast its almost like traveling in time." (4/5)</li>
                            <li class="reviews">"Coolest ride on the road." (4/5)</li>
                            <li class="reviews">"I'm feeling MyFly!" (5/5)</li>
                            <li class="reviews">"The most futuristic ride of our day." (4.5/5)</li>
                            <li class="reviews">"80's livin and I love it!" (5/5)</li>
                        </ol>
                    </div>
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