<?php
include_once('template.php');
include_once('accessLog.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $query = <<<END
        SELECT email, pwd, user_id, is_admin
        FROM user
        WHERE email = '{$email}' AND pwd = '{$password}'
END;
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        $_SESSION['email'] = $row->email;
        $_SESSION['user_id'] = $row->user_id;
        $_SESSION['is_admin'] = $row->is_admin;
        header('Location: index.php');
        exit;
    } else {
        echo 'Wrong email or password. Try again';
    }
}
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="form-container">
  <form class="login-form" action="login.php" method="post">
    <div class="input-wrapper">
    <h1>SIGN IN</h1>
      <input type="text" name="email" placeholder="Email">
    </div>
    <div class="input-wrapper">
      <input type="password" name="password" placeholder="Password">
    </div>
    <button type="submit">Log in</button><br>
    <a href="register.php"><h2>Don't have an account?</h2></a>
  </form>
</div>
<?php
include('footer.php');
?>