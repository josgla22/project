<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $value = $_POST['bedtime'];
  $date = $_POST['date'];

  $email = $_SESSION['email']; 
  $user_query = "SELECT user_id FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $user_query);
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['user_id'];

  $sql = "INSERT INTO bedtime (value, date, user_id)
      VALUES ('{$value}', '{$date}', '{$user_id}')
      ON DUPLICATE KEY UPDATE value = value + VALUES(value)";
  header('Location: tracker.php');
  if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  mysqli_close($conn);
}
echo '<div class="box">';
    echo '<h1 class="heading1">Bedtime</h1>';
    echo '<form method="post" action="bedTime.php">';
    echo '<input type="date" name="date"> ';
        echo '<input type="time" id="bedtime" name="bedtime"><br>';
        echo '<input type="submit" value="Add bedtime"> ';
        echo '<input type="reset" value="Reset">';
    echo '</form>';
echo '</div>';  
?>
<script>
function submitForm() {
  $.ajax({
    url: 'bedTime.php',
    type: 'POST',
    data: $('#bedTime-form').serialize(),
    success: function(response) {
      alert(response);
    
    }
  });
}
</script>
<?php
include('footer.php');
?>