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
    <title>Manage Schedules</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo/459146631_122094564554531793_7023822997315371156_n-removebg-preview.png">
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>

    <div class="navbar">
        <h1>Schedule Manager</h1>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="admin.php">Add Schedule</a>
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

    <div class="container" style="max-width: 1000px;"> 
        <h2>All Class Schedules</h2>

        <?php if (isset($_GET['msg'])) { ?>
            <p class="success"><?php echo $_GET['msg']; ?></p>
        <?php } ?>

        <div class="table-responsive">

            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Section</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT schedule.id, teachers.name, sections.grade_level, sections.section_name, schedule.subject, schedule.day_of_week, schedule.start_time, schedule.end_time 
                            FROM schedule 
                            JOIN teachers ON schedule.teacher_id = teachers.id 
                            JOIN sections ON schedule.section_id = sections.id 
                            ORDER BY FIELD(schedule.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), schedule.start_time";
                    
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['day_of_week'] . "</td>";
                        echo "<td>" . date("g:i A", strtotime($row['start_time'])) . " - " . date("g:i A", strtotime($row['end_time'])) . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['subject'] . "</td>";
                        echo "<td>" . $row['grade_level'] . " - " . $row['section_name'] . "</td>";
                        echo "<td><a href='delete_schedule.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div> </div>

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