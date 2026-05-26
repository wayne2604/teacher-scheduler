<?php include 'db_conn.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>School Schedule System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="HhjbDakVpBZ03qW0v4vEOmFfc-TNMy3VSFMkcqCDgaI" />
    <link rel="icon" type="image/png" href="logo/NEWTURNOLOGO-copy-1.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <h1>Turno NHS Schedule</h1>
        <div class="nav-links">
            <a href="index.php">Search</a>
            <a href="login.php">Admin Login</a>
            
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
        <h2>Find Class Schedule</h2>
        
        <form action="index.php" method="POST" style="margin-bottom: 30px;">
            <label>Search by Teacher or Section:</label>
            <input type="text" name="search" placeholder="Enter Name or Section..." required>
            <button type="submit" name="submit_search">Search</button>
        </form>

        <?php
        if (isset($_POST['submit_search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);

            $sql = "SELECT schedule.day_of_week, schedule.start_time, schedule.end_time, teachers.name, schedule.subject, sections.grade_level, sections.section_name 
                    FROM schedule 
                    JOIN teachers ON schedule.teacher_id = teachers.id 
                    JOIN sections ON schedule.section_id = sections.id 
                    WHERE teachers.name LIKE '%$search%' OR sections.section_name LIKE '%$search%'
                    ORDER BY FIELD(schedule.day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'), schedule.start_time";
            
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
        ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Teacher</th>
                                <th>Subject</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['day_of_week'] . "</td>";
                                echo "<td>" . date("g:i A", strtotime($row['start_time'])) . " - " . date("g:i A", strtotime($row['end_time'])) . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['subject'] . "</td>";
                                echo "<td>" . $row['grade_level'] . " - " . $row['section_name'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div> <?php
            } else {
                echo "<p class='error'>No schedules found for '$search'</p>";
            }
        }
        ?>
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