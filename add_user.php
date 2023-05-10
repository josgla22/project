<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$gender = $_POST['gender'];

// Prepare the insert query
$query = "INSERT INTO user (f_name, l_name, email, pwd, gender) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $fname, $lname, $email, $pwd, $gender);

// Execute the insert query
if ($stmt->execute()) {
    // Redirect to the user list page
    header("Location: edit.php");
    exit;
} else {
    // Display an error message
    $content = "<p>Error adding user: " . $stmt->error . "</p>";
}

echo $navigation;
echo $content;
include('footer.php');
?>