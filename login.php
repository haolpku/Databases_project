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

    // This is a placeholder for actual user authentication which should be implemented here
    // For simplicity, we are assuming the "type" is being sent from the login form
    $type = $_POST['type'];

    if ($type == 'lessor') {
        // Lessor - show form for item input
        echo "<form action='item_input.php' method='post'>
            <label for='item_name'>Item Name:</label>
            <input type='text' id='item_name' name='item_name' required>

            <label for='item_type'>Item Type:</label>
            <input type='text' id='item_type' name='item_type' required>

            <label for='item_value'>Item Value:</label>
            <input type='text' id='item_value' name='item_value' required>

            <label for='rental_period'>Rental Period (days):</label>
            <input type='number' id='rental_period' name='rental_period' required>

            <input type='submit' value='Submit'>
        </form>";
    } else if ($type == 'renter') {
        // Renter - show available items
        $sql = "SELECT item_name, item_type, item_value, rental_period FROM Items";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch()) {
            echo "Item Name: " . $row['item_name'] . "<br>";
            echo "Item Type: " . $row['item_type'] . "<br>";
            echo "Item Value: " . $row['item_value'] . "<br>";
            echo "Rental Period: " . $row['rental_period'] . " days<br><br>";
        }
    }
}
?>
