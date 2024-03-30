<!--
* Group 15: Yuan Tang,Lishu Yuan
* Date: 2023-03-27
* Section: CST 8285 section 302
* Description: the user login page
-->

<?php
session_start();
include("database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    unset($_SESSION['login_error']);
    $email = !empty($_POST["email"]) ? trim($_POST['email']) : "no data";
    $password = !empty($_POST["pass"]) ? trim($_POST['pass']) : "no data";

    $sql = "SELECT email,password FROM users 
       WHERE email='{$email}'";
    $query = mysqli_query($con1, $sql);
    if (!$query) {
        echo "read failure";
        return;
    }
    $row = mysqli_fetch_assoc($query);
    if ($row['email'] == $email && $row['password'] == $password) {
        $_SESSION['email'] = $email; //save the email in the session
        header("Location: reservation.php");
        exit();
    } else {
        echo "not success";
    }
    if ($email && $password) {
        $stmt = $con1->prepare("SELECT email, password FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $password) {
                $_SESSION['email'] = $email; // Save the email in the session
                header("Location: reservation.php");
                exit();
            } else {
                $_SESSION['login_error'] = 'Incorrect password. Please try again.';
            }
        } else {
            $_SESSION['login_error'] = 'Email address does not exist.';
        }
        if (isset($_SESSION['login_error'])) {
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>OTTAWA FITNESS | Your Path to Health and Strength</title>
    <meta name="keywords" content="Ottawa fitness, fitness classes, gym membership" />
    <meta name="description" content="Join OTTAWA FITNESS to start your journey towards health and strength. Explore our classes, sign up for memberships, and more." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0, user-scalable=yes" />
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/login.js" defer></script>
    <script>
        const loginError = <?php echo json_encode($_SESSION['login_error'] ?? ''); ?>;
        if (loginError) {
            alert(loginError);
            // Clear the error message from session to prevent it from popping up again on refresh
            <?php unset($_SESSION['login_error']); ?>
        }
    </script>
</head>

<body>
    <header class="site-header">
        <h1>OTTAWA FITNESS</h1>
        <div class="tagline">Exercise brings health.</div>
        <nav class="navbar">
            <ul>
                <li><a href="../html/index.html">Home</a></li>
                <li><a href="../php/classes.php">Classes</a></li>
                <li><a href="../php/signup.php">Sign Up</a></li>
                <li><a href="../php/login.php">Login</a></li>
                <li><a href="../php/contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>


    <div class="background">
        <div class="login-container">
            <div id="login_error" class="error">
                <?php if (isset($_SESSION['login_error']) && $_SERVER['REQUEST_METHOD'] == 'POST') : ?>
                    <script>
                        alert('<?php echo addslashes($_SESSION['login_error']); ?>');
                    </script>
                    <?php unset($_SESSION['login_error']);  ?>
                <?php endif; ?>
            </div>
            <form id="login_form" method="post" action="login.php">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email">
                </div>
                <p id="email_error" class="error"></p>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" id="pass" name="pass" placeholder="Enter your password">
                </div>
                <p id="pass_error" class="error"></p>
                <div class="form-actions">
                    <button type="submit" class="btn-login">Log in</button>
                </div>
            </form>
            <div class="signup-section">
                <p>Don't have an account?</p>
                <a href="signup.php" class="link-signup">SIGN UP</a>
            </div>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>