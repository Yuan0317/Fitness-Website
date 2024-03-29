<?php
session_start();
include('database.php');
$classes = [
    'Yoga' => 'Yoga for Beginners',
    'Cardio' => 'Cardio Blast',
    'Strength' => 'Strength Training 101',
    'Dance' => 'Zumba Dance Workout',
    'HIIT' => 'High Level HIIT',
    'Swimming' => 'Swimming for Beginners'
];

function make_reservation($class, $time)
{
    // Here you'd have logic to make the reservation, e.g., save to a database
    // For now, we'll randomly simulate success or failure
    return rand(0, 1) > 0.5;
}
$reservation_made = false;
$error = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $class = $_POST['class'] ?? '';
//     $time = $_POST['time'] ?? '';

//     if (!empty($class) && !empty($time)) {
//         $reservation_made = make_reservation($class, $time);

//         if (!$reservation_made) {
//             $error = 'Reservation failed. Please try again later.';
//         }
//     } else {
//         $error = 'Please select both a class and a time.';
//     }
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["reserve"])) {
    $class = $_POST['class'];
    $time = $_POST['time'];
    $email = $_SESSION['email'];

    if (!empty($class) && !empty($time) && !empty($email)) {
        // 首先检查用户是否已经预约了这个课程
        $stmt = $con1->prepare("SELECT * FROM classes WHERE class_name = ? AND user_email = ?");
        $stmt->bind_param("ss", $class, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // 用户已经预约了这个课程
            $error = 'You have already reserved this class.';
        } else {
            // 用户尚未预约这个课程，进行预约
            $stmt = $con1->prepare("INSERT INTO classes (class_name, class_time, user_email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $class, $time, $email);
            if ($stmt->execute()) {
                // 插入成功，重定向到 myfile.php
                $_SESSION['reservation_made'] = true;
                header('Location: myfile.php');
                exit();
            } else {
                // 插入失败
                $error = 'Reservation failed. Please try again later.';
            }
            $stmt->close();
        }
    } else {
        // 未选择课程或时间，或用户未登录
        $error = 'Please select both a class and a time.';
        echo "<p class='error'>" . $error . "</p>";
    }
    $con1->close();
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
    <link rel="canonical" href="../Assign2/main.php" />
    <!-- Additional meta tags and scripts can go here -->
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
                <li><a href="../php/myfile.php">My reservation</a></li>
                <li><a href="../php/logout.php">Log Out</a></li>
                <li><a href="../php/contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <!-- HTML content -->
    <div class="login-container3">
        <?php if ($reservation_made) : ?>
            <p class="success">Reservation successful!</p>
        <?php elseif (!empty($error)) : ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form id="reservation_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="class_selection">Choose a class:</label>
                <select id="class_selection" name="class" onchange="updateTimes(this.value)">
                    <?php
                    // List of classes
                    $classes = [
                        'Yoga' => 'Yoga for Beginners',
                        'Cardio' => 'Cardio Blast',
                        'Strength' => 'Strength Training 101',
                        'Dance' => 'Zumba Dance Workout',
                        'HIIT' => 'High Level HIIT',
                        'Swimming' => 'Swimming for Beginners'
                    ];
                    foreach ($classes as $key => $value) : ?>
                        <option value="<?php echo htmlspecialchars($key); ?>">
                            <?php echo htmlspecialchars($value); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="time_selection">Choose a time:</label>
                <select id="time_selection" name="time">
                </select>
            </div>
            <button type="submit" name='reserve' class="btn-reserve">Reserve</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        const classSchedules = {
            'Yoga': {
                'Tuesday': ['15:00-17:00'],
                'Thursday': ['15:00-17:00'],
                'Saturday': ['19:00-21:00']
            },
            'Cardio': {
                'Wednesday': ['10:00-12:00'],
                'Friday': ['10:00-12:00'],
                'Saturday': ['19:00-21:00'],
            },

            'Strength': {
                'Monday': ['13:00-15:00'],
                'Wednesday': ['10:00-12:00'],
                'Saturday': ['10:00-12:00']
            },
            'Dance': {
                'Monday': ['10:00-12:00'],
                'Sunday': ['10:00-12:00']
            },
            'HIIT': {
                'Tuesday': ['13:00-15:00'],
                'Sunday': ['15:00-17:00']
            },
            'Swimming': {
                'Thursday': ['13:00-15:00'],
                'Sunday': ['13:00-15:00']
            }
        }

        function updateTimes(selectedClass) {
            const timeSelect = document.getElementById('time_selection');
            timeSelect.innerHTML = '';
            if (classSchedules[selectedClass]) {
                for (const [day, times] of Object.entries(classSchedules[selectedClass])) {
                    times.forEach(time => {
                        const option = document.createElement('option');
                        option.value = `${day} ${time}`;
                        option.textContent = `${day} ${time}`;
                        timeSelect.appendChild(option);
                    });
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            updateTimes(document.getElementById('class_selection').value);
        });
    </script>
</body>

</html>