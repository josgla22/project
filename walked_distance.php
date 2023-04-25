<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['distance'];
    $sql = "INSERT INTO walked_distance (value, date)
        VALUES ('{$value}', NOW())
        ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
    if ($conn->query($sql) === TRUE) {
        echo "Distance added";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}
?>
<div class="box">
    <h1>Add distance</h1>
    <form method="post" action="walked_distance.php">
    <input type="text" name="distance" placeholder="Kilometers"><br>
    <input type="submit" value="Add distance">
    <input type="reset" value="Reset">
    </form>
 </div>
<?php
include('footer.php');
?>