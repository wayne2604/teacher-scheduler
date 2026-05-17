<?php
include "db_conn.php";

if (isset($_POST['add_schedule'])) {
    $teacher_id = $_POST['teacher_id'];
    $section_id = $_POST['section_id'];
    $subject = $_POST['subject'];
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // --- CHECK 1: TEACHER CONFLICT ---
    // Is this specific TEACHER already booked?
    $teacher_conflict_sql = "SELECT * FROM schedule 
                             WHERE teacher_id = '$teacher_id' 
                             AND day_of_week = '$day' 
                             AND start_time < '$end_time' 
                             AND end_time > '$start_time'";
    $teacher_result = mysqli_query($conn, $teacher_conflict_sql);

    // --- CHECK 2: SECTION CONFLICT ---
    // Is this specific SECTION (Class) already booked?
    $section_conflict_sql = "SELECT * FROM schedule 
                             WHERE section_id = '$section_id' 
                             AND day_of_week = '$day' 
                             AND start_time < '$end_time' 
                             AND end_time > '$start_time'";
    $section_result = mysqli_query($conn, $section_conflict_sql);

    if (mysqli_num_rows($teacher_result) > 0) {
        // ERROR: The Teacher is busy
        $row = mysqli_fetch_assoc($teacher_result);
        $error_msg = "Teacher Conflict! This teacher is already teaching " . $row['subject'] . " from " . $row['start_time'] . " to " . $row['end_time'];
        header("Location: admin.php?error=$error_msg");
        exit();

    } elseif (mysqli_num_rows($section_result) > 0) {
        // ERROR: The Section (Students) is busy
        $row = mysqli_fetch_assoc($section_result);
        // We need to fetch the section name to be helpful
        $section_query = mysqli_query($conn, "SELECT * FROM sections WHERE id = '$section_id'");
        $sec_info = mysqli_fetch_assoc($section_query);
        
        $error_msg = "Section Conflict! The class " . $sec_info['section_name'] . " already has " . $row['subject'] . " scheduled at this time.";
        header("Location: admin.php?error=$error_msg");
        exit();

    } else {
        // No conflicts found (Teacher is free AND Students are free) -> Save it!
        $sql = "INSERT INTO schedule (teacher_id, section_id, subject, day_of_week, start_time, end_time) 
                VALUES ('$teacher_id', '$section_id', '$subject', '$day', '$start_time', '$end_time')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: admin.php?success=New schedule added successfully");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>