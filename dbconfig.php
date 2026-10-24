<?php
// Connect to the Swiss grocery database using PDO.
$host = 'localhost';
$dbname = 'swiss_grocery_db';
$username = 'root';
$password = ''; // Default XAMPP MySQL password is usually blank.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    // Make PDO throw an exception when a database error occurs.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Return database rows as associative arrays by default.
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed. Please check dbconfig.php and MySQL.");
}
?>
