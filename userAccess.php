<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_query = "SELECT user_id FROM user";
$result = mysqli_query($conn, $user_query);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];

$sql = "SELECT ua.*, al.*
        FROM user_access ua
        INNER JOIN access_log al ON ua.accesslog_id = al.accesslog_id
        WHERE ua.user_id IN (SELECT user_id FROM user)
        ORDER BY ua.user_id ASC";

$result = $conn->query($sql);

?>
<h1>User AccessLog</h1>
<table>
  <tr>
    <th>User ID</th>
    <th>Access Time</th>
    <th>IP Address</th>
    <th>Accessed Page</th>
    <th>Accessed Browser</th>
  </tr>
  <?php

  while ($row = $result->fetch_assoc()) {

    echo "<tr>";
    echo "<td>" . $row["user_id"] . "</td>";
    echo "<td>" . $row["access_time"] . "</td>";
    echo "<td>" . $row["ip_address"] . "</td>";
    echo "<td>" . $row["page"] . "</td>";
    echo "<td>" . $row["browser"] . "</td>";
    echo "</tr>";
  }
  if ($result->num_rows == 0) {
    echo "<tr><td colspan='4'>No results found.</td></tr>";
  }
  ?>
</table>

<?php

$conn->close();
?>
<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ip_address, accesslog_id, access_time, page, browser
        FROM access_log";

$result = $conn->query($sql);

?>
<h1>AccessLog</h1>
<table>
  <tr>
    <th>AccessLog ID</th>
    <th>Access Time</th>
    <th>IP Address</th>
    <th>Accessed Page</th>
    <th>Accessed Browser</th>
  </tr>
  <?php

  while ($row = $result->fetch_assoc()) {

    echo "<tr>";
    echo "<td>" . $row["accesslog_id"] . "</td>";
    echo "<td>" . $row["access_time"] . "</td>";
    echo "<td>" . $row["ip_address"] . "</td>";
    echo "<td>" . $row["page"] . "</td>";
    echo "<td>" . $row["browser"] . "</td>";
    echo "</tr>";
  }

  if ($result->num_rows == 0) {
    echo "<tr><td colspan='4'>No results found.</td></tr>";
  }
  ?>
</table>

<?php

$conn->close();
?>
