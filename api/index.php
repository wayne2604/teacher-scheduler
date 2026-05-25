<?php
// Enable error reporting to help with debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Add root directory to PHP's include path
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__DIR__));

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = ltrim($path, '/');

// Handle homepage
if (empty($path) || $path === 'index.php') {
    require __DIR__ . '/../index.php';
    exit();
}

// Block sensitive files
if ($path === 'db_conn.php' || $path === 'db_conn.php.example' || $path === 'vercel.json' || $path === '.vercelignore') {
    http_response_code(403);
    echo "403 Forbidden - Access Denied";
    exit();
}

// Route to the corresponding PHP file in the root directory
$file = __DIR__ . '/../' . $path;
if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require $file;
    exit();
}

// Fallback to 404
http_response_code(404);
echo "404 Not Found";
