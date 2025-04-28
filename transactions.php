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

// Query the transactions from the transactions table
$sql = "SELECT * FROM transactions"; // Adjust if you need specific columns
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sandalwood Syndicate - Transactions</title>
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

    function openForm() {
      document.getElementById("formOverlay").style.display = "block";
    }

    function closeForm() {
      document.getElementById("formOverlay").style.display = "none";
    }
  </script>

  <!-- Add Transaction Button -->
  <section class="container" id="transactions" data-bg="bg5">
    <h1 style = "font-size: 40px;">Transaction History</h1>
    <button onclick="openForm()" id = "logoutButton">Add Transaction</button>

    <!-- Transactions Table -->
    <table class="crew-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Type</th>
          <th>Money</th>
          <th>Broker</th>
          <th>Product</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Check if the query returned any rows
        if ($result->num_rows > 0) {
            // Output each transaction in the table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Money'] . "</td>";
                echo "<td>" . $row['Broker'] . "</td>";
                echo "<td>" . $row['Product'] . "</td>";
                echo "<td>" . $row['Amount'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No transactions found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </section>

  <!-- Form Overlay (hidden by default) -->
  <div id="formOverlay" class="form-overlay">
    <div class="form-container">
    <h2>Add Transaction</h2>
      <form action="add_transaction.php" method="POST">
        <label for="transaction-id">Transaction ID (Leave empty for auto-increment)</label>
        <input type="number" id="transaction-id" name="transaction-id" placeholder="Transaction ID">

        <label for="type">Type</label>
        <select name="type" id="type">
          <option value="import">Import</option>
          <option value="export">Export</option>
        </select>

        <label for="money">Money</label>
        <input type="number" id="money" name="money" required>

        <label for="broker">Broker (Name from Crew)</label>
        <input type="text" id="broker" name="broker" required>

        <label for="product">Product</label>
        <input type="text" id="product" name="product" required>

        <label for="amount">Amount</label>
        <input type="number" id="amount" name="amount" required>

        <button type="submit">Save</button>
        <button type="button" onclick="closeForm()">Cancel</button>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
