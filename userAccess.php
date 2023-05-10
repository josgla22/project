<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Skapa en anslutning till databasen
$conn = new mysqli($host, $user, $pwd, $db);

$user_query = "SELECT user_id FROM user";
$result = mysqli_query($conn, $user_query);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

// Skapa en SQL-fråga som hämtar information från båda tabellerna
$sql = "SELECT ua.*, al.*
        FROM user_access ua
        INNER JOIN access_log al ON ua.accesslog_id = al.accesslog_id
        WHERE ua.user_id IN (SELECT user_id FROM user)
        ORDER BY ua.user_id ASC";

// Kör SQL-frågan och hämta resultatet
$result = $conn->query($sql);

// Skriv ut en HTML-tabell med resultatet
?>
<h1>Access Log</h1>
<table>
  <tr>
    <th>User ID</th>
    <th>Access Time</th>
    <th>IP Address</th>
    <th>Accessed Page</th>
    <th>Accessed Browser</th>
  </tr>
  <?php
  // Loopa igenom varje rad i resultatet
  while ($row = $result->fetch_assoc()) {
    // Skapa en tabellrad med värdena
    echo "<tr>";
    echo "<td>" . $row["user_id"] . "</td>";
    echo "<td>" . $row["access_time"] . "</td>";
    echo "<td>" . $row["ip_address"] . "</td>";
    echo "<td>" . $row["page"] . "</td>";
    echo "<td>" . $row["browser"] . "</td>";
    echo "</tr>";
  }
  // Om inga resultat hittades, skriv ut ett meddelande i en rad
  if ($result->num_rows == 0) {
    echo "<tr><td colspan='4'>No results found.</td></tr>";
  }
  ?>
</table>

<?php
// Stäng anslutningen till databasen
$conn->close();
?>
