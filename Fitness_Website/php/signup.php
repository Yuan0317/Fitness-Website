<!--
* Group 15: Yuan Tang,Lishu Yuan
* Date: 2023-03-27
* Section: CST 8285 section 302
* Description: the signup page,user input their information,and the information will be 
               saved in the database in the backend.
-->
<?php
session_start();
include("database.php");

$error_message = '';


if (isset($_POST["submit"])) {
    $name = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];


    $stmt = $con1->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $error_message = 'Email address already exists.';
    } else {

        $stmt = $con1->prepare("INSERT INTO users (email, name, password, phone, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $email, $name, $password, $phone, $gender);
        $stmt->execute();


        header('Location: login.php');
        exit();
    }
    $stmt->close();
    mysqli_close($con1);
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
    <div class="background2">
        <div class="login-container2">
            <h1>Create an Account</h1>

            <?php if (!empty($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form name="form" action="signup.php" onsubmit="return validate();" method="post">
                <div class="textfield">
                    <label for="login">Name: </label>
                    <input type="text" name="login" id="login" placeholder="">
                </div>
                <div class="textfield">
                    <label for="email">Email Address: </label>
                    <input type="text" name="email" id="email" placeholder=" ">
                </div>
                <div class="textfield">
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" id="pass" placeholder=" ">
                </div>
                <div class="textfield">
                    <label for="pass2">Re-type Password: </label>
                    <input type="password" id="pass2" placeholder=" ">
                </div>
                <div class="textfield">
                    <label for="phone">Phone: </label>
                    <input type="text" id="phone" name="phone" placeholder="___-____-____">

                </div>
                <div class="textfield">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender">
                        <option value="">Choose an option</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="textfield">
                    <button type="submit" name="submit" class="submit-btn">Sign Up</button>
                    <button type="reset" class="reset-btn">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
<?php
if (isset($_POST["submit"])) {

    $name = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];

    $sql = "INSERT INTO users (email,name,password,phone,gender) VALUES('$email','$name','$password','$phone','$gender')";

    mysqli_query($con1, $sql);
    mysqli_close($con1);
    header('Location:login.php');
}


?>