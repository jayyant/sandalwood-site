<?php
session_start(); // Start the session

$conn = new mysqli("localhost", "root", "", "sandalwood");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['login-email'];
$password = $_POST['login-password']; // Plain password

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

function showError($message) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login Error</title>
        <link rel='stylesheet' href='stylesheet.css'>
        <style>
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background-color: #1a1a1a;
                color: #fff;
                font-family: 'Segoe UI', sans-serif;
            }
            .error-box {
                background: rgba(255, 0, 0, 0.2);
                padding: 30px;
                border-radius: 10px;
                text-align: center;
                backdrop-filter: blur(5px);
            }
            .error-box h1 {
                color: #ff4d4d;
                font-size: 2em;
            }
            .error-box a {
                color: #ffd700;
                text-decoration: none;
                font-weight: bold;
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #333;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
            .error-box a:hover {
                background-color: #444;
            }
        </style>
    </head>
    <body>
        <div class='error-box'>
            <h1>$message</h1>
            <a href='index.php#login'>&larr; Go back to Login</a>
        </div>
    </body>
    </html>
    ";
    exit();
}

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_email'] = $email;
        header("Location: home.php");
        exit();
    } else {
        showError("Incorrect password.");
    }
} else {
    showError("User not found.");
}

$conn->close();
?>
