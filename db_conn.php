<?php
// Retrieve database details from environment variables (used on Vercel)
$sname = getenv('DB_HOST'); 
$uname = getenv('DB_USER');             
$password = getenv('DB_PASS');       
$db_name = getenv('DB_NAME');  

if (!$sname) {
    // If not set, try loading local/InfinityFree credentials from local file
    if (file_exists(__DIR__ . '/db_conn_local.php')) {
        include __DIR__ . '/db_conn_local.php';
        return;
    }
    
    // Default fallback to local xampp or user setting
    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "teacher_schedule";
}

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// This forces the connection to handle special characters correctly
mysqli_set_charset($conn, "utf8mb4");
?>