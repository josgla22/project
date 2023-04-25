<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bedtime = $_POST['getUpTime'];
    $sql = "INSERT INTO get_up_time (value, date)
        VALUES ('{$getUpTime}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Get up time added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}
echo '<div class="box">';
    echo '<h1>Get up time</h1>';
    echo '<form method="post" action="getUpTime.php">';
        echo '<label for="getuptime">Time:</label>';
        echo '<input type="time" id="Time" name="Time">';
        echo '<input type="submit" value="Add time">';
        echo '<input type="reset" value="Reset">';
    echo '</form>';
echo '</div>';

include('footer.php');
?>