<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['hoursSlept'];
    $sql = "INSERT INTO sleeping_hours (value, date)
        VALUES ('{$value}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Hours added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}
echo '<div class="box">';
  echo '<h1>Add sleeping hours</h1>';
  echo '<form method="post" action="sleepingHours.php">';
    echo '<label for="sleepingHours">Hours Slept:</label>';
    echo '<input type="number" id="hoursSlept" name="hoursSlept" min="0">';
    echo '<input type="submit" value="Add time">';
    echo '<input type="reset" value="Reset">';
  echo '</form>';
echo '</div>';
include('footer.php');
?>