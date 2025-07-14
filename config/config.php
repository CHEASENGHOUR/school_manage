<?php

// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session globally
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL (optional, for redirect helpers)
define('BASE_URL', '/');

// Database credentials
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root'); // Change this if needed
define('DB_PASS', 'abc123');     // Add your MySQL password here
define('DB_NAME', 'school1'); // Make sure this database exists

// Autoload (if you're not using Composer, you can write your own autoloader)
// spl_autoload_register(function ($class) {
//     $prefix = 'App\\';
//     $base_dir = __DIR__ . '/../src/';

//     $len = strlen($prefix);
//     if (strncmp($prefix, $class, $len) !== 0) return;

//     $relative_class = substr($class, $len);
//     $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

//     if (file_exists($file)) {
//         require $file;
//     }
// });

?>