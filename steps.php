<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['steps'];
    $sql = "INSERT INTO steps (value, date)
        VALUES ('{$value}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Steps added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}
echo '<div class="box">';
echo '<h1>Add steps</h1>';
echo '<form method="post" action="steps.php">';
echo '<input type="text" name="steps" placeholder="Steps"><br>';
echo '<input type="submit" value="Add steps">';
echo '<input type="reset" value="Reset">';
echo '</form>';
echo '</div>';
include('footer.php');
?>