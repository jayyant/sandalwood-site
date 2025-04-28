<?php
session_start();

$conn = new mysqli("localhost", "root", "", "sandalwood");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_email'])) {
    die("You must be logged in.");
}

$email = $_SESSION['user_email'];
$name = $_POST['name'];
$profession = $_POST['profession'];
$salary = $_POST['salary'];

$stmt = $conn->prepare("UPDATE crew SET Name = ?, Profession = ?, Salary = ? WHERE Email = ?");
$stmt->bind_param("ssis", $name, $profession, $salary, $email);

if ($stmt->execute()) {
    echo "Crew details updated successfully.<br><a href='home.php'>Go back</a>";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
