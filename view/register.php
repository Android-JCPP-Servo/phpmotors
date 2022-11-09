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
                <div class="col-4">
                    <h1>Register</h1>
                    <?php if (isset($message)) { echo $message; } ?>
                    <form action="/phpmotors/accounts/index.php" method="post">
                        <label for="clientFirstname">First Name<br>
                            <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
                        </label>
                        <label for="clientLastname">Last Name<br>
                            <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
                        </label>
                        <label for="clientEmail">Email<br>
                            <input type="text" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                        </label>
                        <label for="clientPassword">Password<br>
                            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character</span>
                            <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </label>
                        <!-- <button id="showPwd" onclick="showPassword()">Show Password</button><br> -->
                        <input type="submit" name="submit" class="register" value="Register">
                        <input type="hidden" name="action" value="register">
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