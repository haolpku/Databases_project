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
    $itemName = $_POST['item_name'];

    try {
        $sql = "UPDATE Items SET is_rented = 1 WHERE item_name = :item_name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['item_name' => $itemName]);

        $response = ['status' => 'success', 'message' => 'The item has been rented.'];
    } catch(PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Failed to rent the item.'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
