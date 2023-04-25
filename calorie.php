<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['calories'];
    $sql = "INSERT INTO calorie (value, date)
        VALUES ('{$value}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Calories added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
echo '<div class="box">';
echo '<h1>Add calories</h1>';
echo '<form method="post" action="calorie.php">';
echo '<input type="text" name="calories" placeholder="Calories"><br>';
echo '<input type="submit" value="Add calories">';
echo '<input type="reset" value="Reset">';
echo '</form>';
echo '</div>';
include('footer.php');
?>