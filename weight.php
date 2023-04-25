<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $weights = $_POST['weight'];
    foreach ($weights as $value) {
        $sql = "INSERT INTO weight (value, date) VALUES ('{$value}', '{$date}') ON DUPLICATE KEY UPDATE value = VALUES(value)";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    echo "Weights added";
}
echo '<div class="box">';
echo '<h1>Add weight</h1>';
echo '<form method="post" action="weight.php">';
echo '<label for="date">Date:</label>';
echo '<input type="date" name="date"><br>';
echo '<label for="weight">Weight:</label>';
echo '<input type="text" name="weight[]" placeholder="Weight"><br>';
echo '<input type="submit" value="Add weight">';
echo '<input type="reset" value="Reset">';
echo '</form>';
echo '</div>';
include('footer.php');
?>