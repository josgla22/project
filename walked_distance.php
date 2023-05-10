<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $value = $_POST['distance'];
  $date = $_POST['date'];

  $email = $_SESSION['email']; 
  $user_query = "SELECT user_id FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $user_query);
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];

  $sql = "INSERT INTO walked_distance (value, date, user_id)
      VALUES ('{$value}', '{$date}', '{$user_id}')
      ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
  header('Location: tracker.php');
  if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
}
?>
<div class="box">
    <h1 class="heading1">Walked distance</h1>
    <form method="post" action="walked_distance.php">
    <input type="date" name="date">
    <input type="text" name="distance" placeholder="Kilometers"><br>
    <input type="submit" value="Add distance">
    <input type="reset" value="Reset">
    </form>
</div>
<script>
function submitForm() {
  $.ajax({
    url: 'walked_distance.php',
    type: 'POST',
    data: $('#walked_distance-form').serialize(),
    success: function(response) {
      alert(response);
    
    }
  });
}
</script>
<?php
include('footer.php');
?>
