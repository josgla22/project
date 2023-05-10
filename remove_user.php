<?php
include_once('template.php');
$id = $_GET['id'];

// Connect to the database
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to delete the user with the given id
$query = "DELETE FROM user WHERE user_id = $id";

// Execute the query
$result = $conn->query($query);

// Check if the deletion was successful
if ($conn->affected_rows == 1) {
    // User was successfully deleted
    header("Location:edit.php");
    exit();
} else {
    // There was an error deleting the user
    echo "Error deleting user: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
<?php
include_once('footer.php');
?>
