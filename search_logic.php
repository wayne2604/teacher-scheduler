<?php
include "db_conn.php";

if (isset($_POST['search'])) {
    $teacher_name = $_POST['teacher_name'];

    // We use LIKE so if you type "Lanojan" it finds "G. Lañojan"
    $sql = "SELECT teachers.name, schedule.subject, sections.grade_level, sections.section_name, schedule.day_of_week, schedule.start_time, schedule.end_time 
            FROM schedule
            JOIN teachers ON schedule.teacher_id = teachers.id
            JOIN sections ON schedule.section_id = sections.id
            WHERE teachers.name LIKE '%$teacher_name%'
            ORDER BY schedule.day_of_week, schedule.start_time";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>Schedule for: " . htmlspecialchars($teacher_name) . "</h3>";
        echo "<table>";
        echo "<tr><th>Day</th><th>Time</th><th>Subject</th><th>Section</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['day_of_week'] . "</td>";
            echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['grade_level'] . " - " . $row['section_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No schedule found for this teacher.</p>";
    }
}
?>