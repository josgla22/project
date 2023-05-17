<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$gender = $_POST['gender'];

$query = "INSERT INTO user (f_name, l_name, email, pwd, gender) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $fname, $lname, $email, $pwd, $gender);

if ($stmt->execute()) {

    header("Location: edit.php");
    exit;
} else {

    $content = "<p>Error adding user: " . $stmt->error . "</p>";
}

echo $navigation;
echo $content;
include('footer.php');
?>