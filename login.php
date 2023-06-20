
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        form, .item-list {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        form input[type='text'], form input[type='number'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        form input[type='submit'] {
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #5C6BC0;
            color: #fff;
            cursor: pointer;
        }

        .item-list h3 {
            margin: 0 0 10px 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .item-list p {
            margin: 0 0 10px 0;
        }
    </style>
</head>
<body>
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
        $sql = "SELECT item_name, item_type, item_value, rental_period FROM Items WHERE is_rented = 0";
        $stmt = $pdo->query($sql);
    
        echo "<style>
            .item-container {
                display: flex;
                overflow-x: auto;
                padding: 10px;
                gap: 10px;
            }
            .item {
                flex: 0 0 auto;
                width: 200px;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 10px;
            }
            .item h3 {
                margin: 0;
                color: #333;
            }
            .item p {
                margin: 0;
                color: #666;
            }
        </style>";
    
        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
        echo "<script>
            function rentItem(itemName) {
                $.ajax({
                    url: 'rent_item.php',
                    type: 'POST',
                    data: {
                        item_name: itemName
                    },
                    success: function(data) {
                        if(data.status == 'success'){
                            location.reload();
                        }
                        else {
                            alert('Something went wrong, please try again');
                        }
                    }
                });
            }
            function returnItem(itemName) {
                $.ajax({
                    url: 'return_item.php',
                    type: 'POST',
                    data: {
                        item_name: itemName
                    },
                    success: function(data) {
                        if(data.status == 'success'){
                            location.reload();
                        }
                        else {
                            alert('Something went wrong, please try again');
                        }
                    }
                });
            }
        </script>";
    
        echo "<h2>Available Items:</h2>";
        echo "<div class='item-container'>";
    
        while ($row = $stmt->fetch()) {
            echo "<div class='item'>";
            echo "<h3>" . $row['item_name'] . "</h3>";
            echo "<p>Type: " . $row['item_type'] . "</p>";
            echo "<p>Value: " . $row['item_value'] . "</p>";
            echo "<p>Rental Period: " . $row['rental_period'] . " days</p>";
            echo "<button onclick='rentItem(\"" . $row['item_name'] . "\")'>Rent this item</button>";
            echo "</div>";
        }
    
        echo "</div>";
    
        // Return rented items
        $sql = "SELECT item_name, item_type, item_value, rental_period FROM Items WHERE is_rented = 1";
        $stmt = $pdo->query($sql);
    
        echo "<h2>Rented Items:</h2>";
        echo "<div class='item-container'>";
    
        while ($row = $stmt->fetch()) {
            echo "<div class='item'>";
            echo "<h3>" . $row['item_name'] . "</h3>";
            echo "<p>Type: " . $row['item_type'] . "</p>";
            echo "</p>";
            echo "<p>Value: " . $row['item_value'] . "</p>";
            echo "<p>Rental Period: " . $row['rental_period'] . " days</p>";
            echo "<button onclick='returnItem(\"" . $row['item_name'] . "\")'>Return this item</button>";
            echo "</div>";
        }

    echo "</div>";
}

    
}
    ?>
</body>
</html

    







