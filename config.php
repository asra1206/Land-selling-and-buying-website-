<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'landbuy_db');
define('SITE_URL', 'http://localhost/landbuy');
define('SITE_NAME', 'LandBuy');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
function isSeller() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'seller';
}
function isBuyer() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'buyer';
}
function redirect($url) {
    header("Location: $url"); exit;
}
function sanitize($conn, $data) {
    return $conn->real_escape_string(htmlspecialchars(trim($data)));
}
function formatPrice($price) {
    return 'Rs. ' . number_format($price);
}
?>
