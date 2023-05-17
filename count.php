<?php
$conn = new mysqli($host, $user, $pwd, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT ip_address, COUNT(*) as count, MAX(access_time) as last_access_time FROM access_log GROUP BY ip_address ORDER BY count DESC";
$result = mysqli_query($conn, $query);

echo '<h1>IP Tracker</h1>';
echo '<table>';
echo '<tr><th>IP Address</th><th>Number of Accesses</th><th>Last Access Time</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    $ip_address = $row['ip_address'];
    $count = $row['count'];
    $last_access_time = $row['last_access_time'];
    echo "<tr><td>$ip_address</td><td>$count</td><td>$last_access_time</td></tr>";
}
echo '</table>';

?>