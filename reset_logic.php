<?php
include "db_conn.php";

if (isset($_POST['update_password'])) {
    $token = $_POST['token'];
    $new_pass = $_POST['new_password'];

    // Update password where token matches
    $sql = "UPDATE users SET password='$new_pass', reset_token=NULL WHERE reset_token='$token'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?success=Password Reset Successful! Please Login.");
    } else {
        echo "Invalid or expired token.";
    }
}
?>