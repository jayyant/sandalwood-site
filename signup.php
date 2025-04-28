<?php
session_start(); // Start session to store user data

$conn = new mysqli("localhost", "root", "", "sandalwood");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['signup-email'];
$password = password_hash($_POST['signup-password'], PASSWORD_DEFAULT);

// Insert into users table
$sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
if ($conn->query($sql) === TRUE) {

    // Now insert into crew table
    $sql_crew = "INSERT INTO crew (email) VALUES ('$email')";
    if ($conn->query($sql_crew) === TRUE) {

        // Save user in session and redirect
        $_SESSION['user_email'] = $email;
        header("Location: home.php");
        exit();

    } else {
        echo "Error inserting into crew: " . $conn->error;
    }

} else {
    echo "Error inserting into users: " . $conn->error;
}

$conn->close();
?>
