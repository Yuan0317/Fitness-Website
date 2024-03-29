<?php
session_start();
include("database.php");

$loggedIn = isset($_SESSION['email']);

//function for delete classes 
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $con1->prepare("DELETE FROM classes WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<p>Reservation deleted successfully.</p>";
    } else {
        echo "<p>Error deleting reservation.</p>";
    }
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

//function for update
if (isset($_POST["update"])) {
    // Get the ID of the reservation to be updated
    $update_id = $_POST['update_id'];
    // Clear old reservation with the same ID
    $stmt = $con1->prepare("DELETE FROM classes WHERE id = ?");
    $stmt->bind_param("i", $update_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to reservation page for rebooking
    header('Location: reservation.php');
    exit();
}



// function for add classes
function classes($con1)
{
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    if (!$email) {
        echo "You are not logged in.";
        return;
    }

    $stmt = $con1->prepare("SELECT * FROM classes WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table class='reservation-table'>";
    echo "<tr><th>Class</th><th>Time</th><th>Action</th></tr>"; // table header
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //for each record has one row
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['class_time']) . "</td>";
            echo "<td>
            <form action='' method='POST'>
            <input type='hidden' name='update_id' value='" . $row['id'] . "'>
            <button type='submit' name='update' class='btn-update'>Update</button>
            <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
            <input type='submit' name='delete' value='Delete' class='delete-btn'>     
        </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>You have no reservations.</td></tr>";
    }
    echo "</table>";

    $stmt->close();
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
                <li><a href="../html/indexin.html">Home</a></li>
                <li><a href="../php/classes.php">Classes</a></li>
                <?php if ($loggedIn) : ?>
                    <li><a href="../php/myfile.php">My reservation</a></li>
                    <li><a href="../php/logout.php">Log Out</a></li>
                <?php else : ?>
                    <li><a href="../php/signup.php">Sign Up</a></li>
                    <li><a href="../php/login.php">Login</a></li>
                <?php endif; ?>
                <li><a href="../php/contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <h2>Welcome to your reservation!</h2>
    <div class="login-container3">
        <!-- <?php echo ($_SESSION['email']) ?>; -->

        <div class="cards" id="class-cards">
            <?php

            classes($con1); ?>
        </div>

        <form action="reservation.php" method="post">
            <button type="submit" class="btn-reserve">Book now!</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>