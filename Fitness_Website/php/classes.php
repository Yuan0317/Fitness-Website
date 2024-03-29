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
    <!-- 
    <style>
.cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .sport-card {
            background-color: white;
            color: black;
            padding: 1.3rem;
            margin: 1.2rem;
            width: 300px;
            border-radius: 15px;
        }

        .sport-card img {
            width: 100%;
            /* Adjust based on your needs */
            height: auto;
        }


        @media (max-width: 768px) {
            .team-stats {
                flex-direction: column;
            }

            .filter-container {
                flex-direction: column;
            }

            .filter-container>div {
                justify-content: center;
                /* 在较小屏幕上居中显示 */
            }

            #searchInput {
                margin-right: 0;
                /* 在较小屏幕上移除间距 */
            }
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            /* 使子元素分布在两端 */
            flex-wrap: wrap;
            /* 允许子元素在必要时换行 */
            gap: 20px;
            /* 添加一些间隙 */
            margin-bottom: 20px;
            /* 添加一些底部外边距 */
        }

        .filter-container>div {
            flex: 1;
            /* 使每个子容器灵活地填充空间 */
            display: flex;
            align-items: center;
            /* 垂直居中对齐子元素 */
        }

        .search-input-container {
            justify-content: flex-end;
            /* 将搜索框和按钮推向右侧 */
        }

        #searchInput {
            padding: 0.5rem;
            /* 增加填充使输入框更高 */
            margin-right: 10px;
            /* 在输入框和按钮之间添加一些间距 */
            width: 200px;
            /* 允许输入框根据内容自动调整宽度 */

        }
    </style> -->

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