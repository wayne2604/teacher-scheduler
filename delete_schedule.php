<?php
include "db_conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the row with this specific ID
    $sql = "DELETE FROM schedule WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        // Go back to the list with a success message
        header("Location: manage_schedule.php?msg=Schedule deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>