<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sandalwood"; // Replace with your DB name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "sandalwood";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sandalwood Syndicate</title>
  <link rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
  <header id="header">Sandalwood & Co.</header>
  <nav>
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#founders">Founders</a>
    <a href="#login">Login/Signup</a>
  </nav>

  <section id="home" class="container" data-bg="bg1">
    <h1>Welcome to the Home Page</h1>
    <?php
    if (isset($_SESSION['user_email'])) {
      echo "<p>Welcome, " . htmlspecialchars($_SESSION['user_email']) . "!</p>";
    }
    ?>
    <p>This is the official website for the Sandalwood Syndicate LLC.<br>If you are part of our crew, please login. For new recruits, sign up.</p>
  </section>

  <section id="about" class="container" data-bg="bg2">
    <h1>About Us</h1>
    <p>Sandalwood Syndicate LLC specializes in red sandalwood trade. Founded in 2010 by Pushpa Raj, the company has grown to become a trusted name in the industry. Through relentless hard work, dedication, and an unwavering commitment to authenticity, we have built a reputation for delivering the finest quality products to our clients. Our team believes in upholding ethical practices and fostering long-term relationships with our partners, ensuring that every transaction reflects our core values of integrity and excellence.</p>
  </section>

  <section id="founders" class="container" data-bg="bg3">
    <h1 class="box">Founders</h1>
    <p id="founderInfo" class="box">
      <img src="https://m.media-amazon.com/images/M/MV5BOGJkMzRiYmQtOTVjNy00MWU3LTg5YjctNjcwMmZlNGIwMjhmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg" alt="Pushpa Raj" id="pushpa">
      Pushpa Raj, once a name whispered through the forests of Seshachalam, rose to become a visionary leader who redefined the legacy of the sandalwood trade. With sharp instincts and an unbreakable will, he transformed the once-shadowy syndicate into a globally recognized, legally operating enterprise. Under his guidance, the Sandalwood Syndicate not only embraced transparency and innovation but also set international benchmarks in sustainable forestry and ethical exports. From the heart of Andhra to boardrooms across the world, Pushpa Raj led with passion, purpose, and a fierce loyalty to his roots — proving that even the most unexpected beginnings can carve out legendary futures.
    </p>
  </section>

  <section id="login" class="container" data-bg="bg4">
    <h1>Login/Signup</h1>
    <form action="login.php" method = "POST">
      <h2>Login</h2>
      <label for="login-email">Email:</label>
      <input type="email" id="login-email" name = "login-email" placeholder = "Email" required><br><br>
      <label for="login-password">Password:</label>
      <input type="password" id="login-password" name = "login-password" placeholder = "password" required><br><br>
      <button class = "detailButton" type="submit">Login</button>
    </form>
    <hr>
    <form action = "signup.php" method = "POST">
      <h2>Signup</h2>
      <label for="signup-email">Email:</label>
      <input type="email" id="login-email" name = "signup-email" placeholder = "Email" required><br><br>
      <label for="login-password">Password:</label>
      <input type="password" id="login-password" name = "signup-password" placeholder = "password" required><br><br>
      <button class = "detailButton"type="submit">Sign Up</button>
    </form>
  </section>

  <script src="script.js"></script>
</body>
</html>
