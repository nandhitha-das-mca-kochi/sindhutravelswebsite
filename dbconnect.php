<?php
$host = "localhost";  // Server name (XAMPP runs locally)
$user = "root";       // Default MySQL username
$pass = "";           // Default password (empty in XAMPP)
$dbname = "tours_db";  // Database name
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
    echo "connected successfully";
}
?>
