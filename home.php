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
  <header id="header">
  <button class="openbtn" onclick="openNav()">☰ Menu</button>
  Sandalwood & Co.
  </header>
  
  <!-- Sidenav -->
  <div id="sidenav" class="sidenav">
   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
   <a href="home.php" onclick="closeNav()">Home</a>
   <a href="crew.php">Crew</a>
   <a href="transactions.php">Import/Export</a>
  </div>

  <!-- Overlay -->
  <div id="overlay" class="overlay" onclick="closeNav()"></div>
<script>
  function openNav() {
  document.getElementById("sidenav").style.width = "250px";
  document.getElementById("overlay").style.display = "block";
}

function closeNav() {
  document.getElementById("sidenav").style.width = "0";
  document.getElementById("overlay").style.display = "none";
}
</script>
<section id="home" class="container" data-bg="bg5">
  <h1>Welcome to the #1 import/export management site.</h1>

  <?php
  if (isset($_SESSION['user_email'])) {
      $email = $_SESSION['user_email'];
      echo "<p>Logged in as, " . htmlspecialchars($email) . ".</p>";

      // Fetch existing crew details for this user
      $stmt = $conn->prepare("SELECT Name, Profession, Salary FROM crew WHERE Email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($name, $profession, $salary);
      $stmt->fetch();
      $stmt->close();
  ?>
      <form action="update_crew.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"></label><br>
        <label>Profession: <input type="text" name="profession" value="<?php echo htmlspecialchars($profession); ?>"></label><br>
        <label>Salary: <input type="number" name="salary" value="<?php echo htmlspecialchars($salary); ?>"></label><br>
        <button type="submit" id = "logoutButton">Save</button>
      </form>
      <form action="logout.php" method="POST">
        <button type="submit" id="logoutButton">Logout</button>
      </form>
  <?php
  }
  ?>
</section>

  <script src="script.js"></script>
</body>
</html>
