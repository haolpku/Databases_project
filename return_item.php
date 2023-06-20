<?php

$host = 'localhost';
$db   = 'booking_system_1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['item_to_return'])) {
        $item_name = $_POST['item_to_return'];

        $sql = "UPDATE Items SET is_rented = 0 WHERE item_name = :item_name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['item_name' => $item_name]);

        header('Location: login.php');
        exit();
    }
}
