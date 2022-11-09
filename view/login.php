<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/phpmotors_css.css" media="screen" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@300;400&display=swap" rel="stylesheet" />
    <title>Account Sign-In | PHP Motors</title>
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
                    <h1>Sign In</h1>
                    <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
                    <form method="post" action="/phpmotors/accounts/">
                        <label for="clientEmail">Email
                            <input type="text" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                        </label>
                        <label for="clientPassword">Password<br>
                        <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</span>
                            <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </label>
                        <button type="submit" name="sign_in" class="sign_in">Sign-in</button><br>
                        <input type="hidden" name="action" value="Login">
                        <a href="/phpmotors/accounts/index.php?action=create" id="register_link">Don't have an account?</a>
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
<script>
    // Referenced from https://www.javascripttutorial.net/javascript-dom/javascript-toggle-password-visibility/
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#clientPassword");
    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        // toggle the icon
        this.classList.toggle("bi-eye");
    });
</script>
</html>