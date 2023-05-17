<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM user";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $content = "<h1>MANAGE USERS</h1>";
    while ($row = $result->fetch_assoc()) {
        $content .= <<<END
        <form method="post" action="edit_user.php">
            <input type="text" name="fname" value="{$row['f_name']}"><br>
            <input type="text" name="lname" value="{$row['l_name']}"><br>
            <input type="text" name="email" value="{$row['email']}"><br>
            <input type="text" name="pwd" value="{$row['pwd']}"><br>
            <input type="text" name="gender" value="{$row['gender']}"><br>
            <input type="hidden" name="id" value="{$row['user_id']}"><br>
            <button type="submit" name="action" value="Save" onclick="return confirm('Are you sure you want to edit this user?')">Save</button>
            <button type="button" onclick="deleteUser({$row['user_id']})">Delete</button>
        </form><br>
END;
    }
    $content .= <<<END
    <p>Add a new user:</p>
    <form method="post" action="add_user.php">
        <input type="text" name="fname" placeholder="First Name"><br>
        <input type="text" name="lname" placeholder="Last Name"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="text" name="pwd" placeholder="Password"><br><br>
        <input type="radio" name="gender" value="M">Male
        <input type="radio" name="gender" value="F">Female
        <input type="radio" name="gender" value="O">Others<br>
        <input type="hidden" name="id" value=""><br>
        <button type="submit" name="action" value="Add">Add</button>
    </form>
END;
} else {
    $content = "<p>No users found.</p>";
}

echo $navigation;
echo $content;
include('footer.php');
?>

<script>
function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    window.location.href = "remove_user.php?id=" + userId;
  }
}
</script>
