<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user id from the submitted form data
$id = $_POST['id'];

// Get the updated user information from the submitted form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$gender = $_POST['gender'];

// Update the user record in the database
$query = "UPDATE user SET f_name='$fname', l_name='$lname', email='$email', pwd='$pwd', gender='$gender' WHERE user_id='$id'";
$result = $conn->query($query);

// Check if the update was successful
if ($result) {
    // User was successfully deleted
    header("Location:edit.php");
    exit();
}

// Close the database connection
$conn->close();
?>
