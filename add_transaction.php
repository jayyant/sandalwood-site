<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sandalwood";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction-id']; // Can be empty, for auto-increment
    $type = $_POST['type'];
    $money = $_POST['money'];
    $broker = $_POST['broker'];
    $product = $_POST['product'];
    $amount = $_POST['amount'];

    // Insert transaction into database
    $sql = "INSERT INTO transactions (ID, Type, Money, Broker, Product, Amount) 
            VALUES (NULL, '$type', $money, '$broker', '$product', $amount)";
    
    if ($conn->query($sql) === TRUE) {
        echo "New transaction added successfully!";
        header("Location: transactions.php"); // Redirect to transactions page
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
