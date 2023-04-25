<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bedtime = $_POST['bedtime'];
    $sql = "INSERT INTO bedtime (value, date)
        VALUES ('{$bedtime}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Bedtime added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}
echo '<div class="box">';
    echo '<h1>Bedtime</h1>';
    echo '<form method="post" action="bedTime.php">';
        echo '<label for="bedtime">Bedtime:</label>';
        echo '<input type="time" id="bedtime" name="bedtime">';
        echo '<input type="submit" value="Add bedtime">';
        echo '<input type="reset" value="Reset">';
    echo '</form>';
echo '</div>';  
include('footer.php');
?>