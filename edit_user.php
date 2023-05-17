<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$gender = $_POST['gender'];

$query = "UPDATE user SET f_name='$fname', l_name='$lname', email='$email', pwd='$pwd', gender='$gender' WHERE user_id='$id'";
$result = $conn->query($query);

if ($result) {
    header("Location:edit.php");
    exit();
}

$conn->close();
?>
