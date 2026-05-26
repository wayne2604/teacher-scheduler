<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_conn.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo/NEWTURNOLOGO-copy-1.png">
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

    <div class="navbar">
        <h1>Admin Panel</h1>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="manage_schedule.php">Manage List</a>
            <a href="logout.php">Logout</a>

            <div class="theme-switch-wrapper">
                <span id="theme-label" class="theme-status">Light Mode</span>
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <div class="slider round"></div>
                </label>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Add New Class Schedule</h2>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <form action="add_schedule_logic.php" method="POST">
            <label>Teacher:</label>
            <select name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php 
                $result = mysqli_query($conn, "SELECT * FROM teachers ORDER BY name");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
            <label>Section:</label>
            <select name="section_id" required>
                <option value="">Select Section</option>
                <?php 
                $result = mysqli_query($conn, "SELECT * FROM sections ORDER BY grade_level, section_name");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['grade_level'] . " - " . $row['section_name'] . "</option>";
                }
                ?>
            </select>
            <label>Subject:</label>
            <input type="text" name="subject" placeholder="e.g. Science" required>
            <label>Day:</label>
            <select name="day" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>
            <label>Start Time:</label>
            <input type="time" name="start_time" required>
            <label>End Time:</label>
            <input type="time" name="end_time" required>

            <button type="submit" name="add_schedule">Add Schedule</button>
        </form>
    </div>

    <script>
        const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
        const themeLabel = document.getElementById('theme-label');
        const currentTheme = localStorage.getItem('theme');

        if (currentTheme) {
            document.body.classList.add(currentTheme);
            if (currentTheme === 'dark-mode') {
                toggleSwitch.checked = true;
                themeLabel.textContent = "Dark Mode";
            }
        }

        function switchTheme(e) {
            if (e.target.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark-mode');
                themeLabel.textContent = "Dark Mode";
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
                themeLabel.textContent = "Light Mode";
            }
        }
        toggleSwitch.addEventListener('change', switchTheme, false);
    </script>
</body>
</html>