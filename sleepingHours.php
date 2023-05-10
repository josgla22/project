<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $value = $_POST['hoursSlept'];
  $date = $_POST['date'];

  $email = $_SESSION['email']; 
  $user_query = "SELECT user_id FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $user_query);
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];

  $sql = "INSERT INTO sleeping_hours (value, date, user_id)
      VALUES ('{$value}', '{$date}', '{$user_id}')
      ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
  header('Location: tracker.php');
  if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
}
echo '<div class="box">';
  echo '<h1 class="heading1">Sleeping hours</h1>';
  echo '<form method="post" action="sleepingHours.php">';
  echo '<input type="date" name="date"> ';
    echo '<input type="number" id="hoursSlept" name="hoursSlept" min="0" placeholder="Hours"><br>';
    echo '<input type="submit" value="Add time"> ';
    echo '<input type="reset" value="Reset">';
  echo '</form>';
echo '</div>';
?>
<script>
function submitForm() {
  $.ajax({
    url: 'sleepingHours.php',
    type: 'POST',
    data: $('#sleepingHours-form').serialize(),
    success: function(response) {
      alert(response);
    
    }
  });
}
</script>
<?php
include('footer.php');
?>