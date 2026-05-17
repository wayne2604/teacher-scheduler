<?php
session_start();
include "db_conn.php";

if (isset($_POST['login_btn'])) {
    // 1. Get the data from the form
    $email_or_user = $_POST['username']; // This input handles both Username OR Email
    $password = $_POST['password'];

    // 2. Check the database for a match
    // We search where (username matches OR email matches) AND password matches
    $sql = "SELECT * FROM users WHERE (username='$email_or_user' OR email='$email_or_user') AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // 3. If we found exactly one user
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Save user info in the session (like a digital ID card)
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role']; 

        // 4. Traffic Control: Admins go to Admin Panel, Users go to Home
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit();
        
    } else {
        // Login Failed
        header("Location: login.php?error=Incorrect email/username or password");
        exit();
    }
} else {
    // If someone tries to open this file directly without clicking Login
    header("Location: login.php");
    exit();
}
?>