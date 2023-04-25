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
$content = <<<END
END;
echo $navigation;
echo $content;
include('footer.php');
?>
<div class="box">
    <h1>Add steps</h1>
    <form method="post" action="steps.php">
        <input type="text" name="steps" placeholder="Steps"><br>
        <input type="submit" value="Add steps">
        <input type="reset" value="Reset">
    </form>
</div>