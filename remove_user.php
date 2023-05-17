<?php
include_once('template.php');
$id = $_GET['id'];
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "DELETE FROM user WHERE user_id = $id";
$result = $conn->query($query);

if ($conn->affected_rows == 1) {

    header("Location:edit.php");
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}

$conn->close();
?>
<?php
include_once('footer.php');
?>
