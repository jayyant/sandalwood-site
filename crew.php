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

session_start();

// Query the crew members from the crew table
$sql = "SELECT * FROM crew"; // Adjust if you need specific columns
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sandalwood Syndicate - Crew</title>
  <link rel="stylesheet" href="stylesheet.css"/>
  <script src="script.js"></script>
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
  <!-- Crew Table Section -->
  <section class="container" id="crew" data-bg="bg5">
    <h1>Our Crew</h1>

    <!-- Crew Table -->
    <table class="crew-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Job</th>
          <th>Email</th>
          <th>Salary</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Output each crew member in the table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Profession'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Salary'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No crew members found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </section>
  <script src="script.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
