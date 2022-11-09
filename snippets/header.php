<div class="row main-header">
    <div class="col-4">
        <img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo" id="logo">
    </div>
    <div class="col-4"></div>
    <div class="col-4">
        <?php
            if(isset($_SESSION['loggedin'])) {
                echo "<span class='user'>";
                echo "<a href='/phpmotors/accounts/index.php?action=admin' class='welcome-message'>".$_SESSION['clientData']['clientFirstname']."</a>";
                echo '&ensp;|';
                echo "<a href='/phpmotors/accounts/index.php?action=logout' class='log-out'>";
                echo "Log Out</a></span>";
            } else {
                echo "<a href='/phpmotors/accounts/index.php?action=login' id='account'>My Account</a>";
            }
        ?>
    </div>
</div>