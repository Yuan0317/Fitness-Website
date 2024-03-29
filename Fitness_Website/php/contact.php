<?php
session_start();
include("database.php");

$loggedIn = isset($_SESSION['email']);
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // 准备一个 SQL 语句来插入数据
    $stmt = $con1->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // 执行语句并检查是否成功
    if ($stmt->execute()) {
        $success = "Send successfully!";
    } else {
        $success = "Error: " . $con1->error;
    }

    // 关闭语句和连接
    $stmt->close();
    $con1->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>OTTAWA FITNESS | Your Path to Health and Strength</title>
    <meta name="keywords" content="Ottawa fitness, fitness classes, gym membership"/>
    <meta name="description" content="Join OTTAWA FITNESS to start your journey towards health and strength. Explore our classes, sign up for memberships, and more."/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0, user-scalable=yes"/>
    <!-- Additional meta tags and scripts can go here -->
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
            <?php if ($loggedIn): ?>
                <li><a href="../php/myfile.php">My reservation</a></li>
                <li><a href="../php/logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="../php/signup.php">Sign Up</a></li>
                <li><a href="../php/login.php">Login</a></li>
            <?php endif; ?>
            <li><a href="../php/contact.php">Contact Us</a></li>
        </ul>
    </nav>
</header>

    <div class="form-wrapper1">
    <h2>QUESTIONS? CONTACT US!</h2>
        <!--<form id="contactForm" class="form">-->
        <form name="form" action="contact.php" id="contactForm" method="post">        <div class="form-field">
            <label>Full Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your full name…" required >
          </div>
    
          <div class="form-field">
            <label>Email Address</label>
            <input type="email" name="email" id="email" placeholder="Enter your email address…" required >
          </div>
    
          <div class="form-field">
            <label>Subject</label>
            <input type="text" name="subject" id="subject" placeholder="Enter a subject…" >
          </div>
    
          <div class="form-field">
            <label>Message</label>
            <textarea name="message" id="message" placeholder="Enter your message…"></textarea>
          </div>
    
          <button type="submit" id="submit-c">Send Message</button>
        </form>
        <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
          
</body>
</html>