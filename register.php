<?php
$host = 'localhost';
$db   = 'booking_system_1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    $sql = "INSERT INTO users (username, password, type) VALUES (?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$username, $password, $type]);

    // Fetch the username from the database
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Output the success message
    echo "Thanks for Register, user " . htmlspecialchars($user['username']) . ".";
}
?>