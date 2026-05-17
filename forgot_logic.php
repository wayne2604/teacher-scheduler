<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "db_conn.php";

if (isset($_POST['reset_request'])) {
    $email = $_POST['email'];

    // 1. Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        
        // 2. Generate Token
        $token = bin2hex(random_bytes(50));
        
        // 3. Save Token to Database
        $update = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        if (!mysqli_query($conn, $update)) {
            echo "Database error: " . mysqli_error($conn);
            exit();
        }

        // 4. PREPARE THE EMAIL (Using PHPMailer)
        $mail = new PHPMailer(true);

        try {
            // --- Server settings ---
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'znnhsturno2026@gmail.com';                // YOUR GMAIL ADDRESS
            $mail->Password   = 'woew wbuc lxal cmjj';       // YOUR GOOGLE APP PASSWORD (NOT your login password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to

            // --- Recipients ---
            $mail->setFrom('znnhsturno2026@gmail.com', 'ZNNHS - Turno Admin'); // Who is sending it?
            $mail->addAddress($email);                                  // Who is receiving it?

            // --- Content ---
            $reset_link = "http://turnohighschool.infinityfreeapp.com/reset_password.php?token=" . $token;
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "
                <h3>Password Reset Request</h3>
                <p>Click the link below to reset your password:</p>
                <a href='$reset_link'>$reset_link</a>
                <br><br>
                <p>If you did not request this, please ignore this email.</p>
            ";

            $mail->send();
            
            // Redirect back with success message
            echo "<script>
                    alert('Reset link has been sent to your email.');
                    window.location.href='login.php';
                  </script>";

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        echo "<script>alert('Email not found!'); window.location.href='forgot_password.php';</script>";
    }
}
?>