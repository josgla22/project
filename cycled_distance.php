<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['distance'];
    $sql = "INSERT INTO cycled_distance (value, date)
        VALUES ('{$value}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Distance added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}
echo '<div class="box">';
    echo '<h1>Cycled Distance</h1>';
    echo '<form method="post" action="cycled_distance.php">';
        echo '<input type="text" name="Distance" placeholder="Distance"><br>';
        echo '<input type="submit" value="Add Distance">';
        echo '<input type="reset" value="Reset">';
    echo '</form>';
echo '</div>';
include('footer.php');
?>