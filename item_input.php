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
    $item_name = $_POST['item_name'];
    $item_type = $_POST['item_type'];
    $item_value = $_POST['item_value'];
    $rental_period = $_POST['rental_period'];

    $sql = "INSERT INTO Items (item_name, item_type, item_value, rental_period) VALUES (:item_name, :item_type, :item_value, :rental_period)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':item_name', $item_name);
    $stmt->bindParam(':item_type', $item_type);
    $stmt->bindParam(':item_value', $item_value);
    $stmt->bindParam(':rental_period', $rental_period);

    $stmt->execute();
    
    echo "<h2>Thanks for submission!</h2>";
}
?>
