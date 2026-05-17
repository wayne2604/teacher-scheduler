<?php
include "db_conn.php";

if (isset($_POST['register_btn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: In a real app, use password_hash()

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        header("Location: register.php?error=Email already taken");
        exit();
    }

    // Insert new user (Default role is 'user')
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?success=Account created! Please login.");
    } else {
        header("Location: register.php?error=Database error");
    }
}
?>