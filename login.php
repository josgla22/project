<?php
include('template.php');
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
<form action="login.php" method="post">
<input type="text" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<input type="submit" value="Login">
</form>
<?php
include('footer.php');
?>