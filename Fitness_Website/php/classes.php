<!--
* Group 15: Yuan Tang,Lishu Yuan
* Date: 2023-03-27
* Section: CST 8285 section 302
* Description: the classes page php file
-->

<?php
session_start();
include("database.php");

$loggedIn = isset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OTTAWA FITNESS | Your Path to Health and Strength</title>
    <link rel="stylesheet" href="../css/style.css">

<body>
    <header class="site-header">
        <h1>OTTAWA FITNESS</h1>
        <div class="tagline">Exercise brings health.</div>
        <nav class="navbar">
            <ul>
                <li><a href="../html/index.html">Home</a></li>
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

    <div class="structure">
        <div class="filter-container">
            <div>
                <label class="filter" for="activitiesDropdownList">Filter Sports:</label>
                <select name="activityType" id="activitiesDropdownList">
                    <option value="all">All Activities</option>
                    <option value="Aerobics">Aerobics</option>
                    <option value="Strength">Strength</option>
                    <option value="Group Class">Group Class</option>
                    <option value="Solo Class">Solo Class</option>
                </select>
            </div>
            <div class="search-input-container">
                <input type="text" id="searchInput" placeholder="Search for classes...">
                <button onclick="searchClasses()">Search</button>
            </div>
        </div>


        <div class="cards" id="sport-cards">
            <div class="sport-card">
                <h2>Zumba</h2>
                <p>category: Aerobics</p>
                <img src="../pictures/zumba.jpg" alt="run">
            </div>
            <div class="sport-card">
                <h2>Yoga</h2>
                <p>category: Group Class</p>
                <img src="../pictures/yoga.jpg" alt="yoga">
            </div>
            <div class="sport-card">
                <h2>Battle-ropes</h2>
                <p>category: Solo Class</p>
                <img src="../pictures/battle-ropes.jpg" alt='mind'>
            </div>
            <div class="sport-card">
                <h2>Boxing</h2>
                <p>category: Strength</p>
                <img src="../pictures/box.jpg" alt='box'>
            </div>
            <div class="sport-card">
                <h2>HIIT</h2>
                <p>category: Aerobics</p>
                <img src="../pictures/workout.jpg" alt="hiit">
            </div>
            <div class="sport-card">
                <h2>Swimming</h2>
                <p>category: Aerobics</p>
                <img src="../pictures/swim.jpg" alt="Swimming">
            </div>

        </div>
        <?php include '../php/footer.php'; ?>
        <script src="../js/class.js"></script>
</body>

</html>