<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);
if (isset($_POST['f_name']) && isset($_POST['l_name']) && isset($_POST['email']) 
    && isset($_POST['pwd']) && isset($_POST['gender'])) {

    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $query = <<<END
        INSERT INTO user(l_name, f_name, email, pwd, gender, is_admin) 
        VALUES('{$_POST['l_name']}', '{$_POST['f_name']}', '{$_POST['email']}', 
            '{$_POST['pwd']}', '{$_POST['gender']}', '{$is_admin}');
END;
        if ($stmt = $conn->query($query) !== TRUE) {
            die("Could not query database" . $conn->errno . " : " . $conn->error);
            header('Location:index.php');
    }
}
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="form-container">
    <form class="login-form" action="register.php" method="post">
    <h1>Sign Up</h1>
    <form method="post" action="register.php">
        <input type="text" name="f_name" placeholder="First name"><br>
        <input type="text" name="l_name" placeholder="Last name"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <label>Gender:</label>
        <input type="radio" name="gender" value="M">Male
        <input type="radio" name="gender" value="F">Female
        <input type="radio" name="gender" value="O">Others
    <button type="submit">Register</button><br> 
  </form>
</div>
<?php
include('footer.php');
?>
