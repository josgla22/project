<?php
include('template.php');
$conn = new mysqli($host, $user, $pwd, $db);
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $query = <<<END
        INSERT INTO users(username,password,email,fname,lname)
            VALUES('{$_POST['username']}','{$_POST['password']}','
                {$_POST['email']}','{$_POST['fname']}','{$_POST['lname']}')
END;
        if ($stmt = $conn->query($query) !== TRUE) {
            die("Could not query database" . $conn->errno . " : " . $conn->error);
            header('Location:index.php');
    }
}
if (isset($_POST['msg'])) {
    $to = 'healtdashboard123453434234@hotmail.com'; // Enter your email address here
    $subject = 'Feedback from Health Dashboard';
    $message = "First name: {$_POST['fname']}\n";
    $message .= "Last name: {$_POST['lname']}\n";
    $message .= "Email address: {$_POST['email']}\n";
    $message .= "Gender: {$_POST['gender']}\n";
    $message .= "How did you find us?: {$_POST['website']}\n";
    $message .= "Feedback: {$_POST['msg']}\n";
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    if (mail($to, $subject, $message, $headers)) {
        echo "<p>Your feedback has been sent successfully!</p>";
    } else {
        echo "<p>Failed to send your feedback. Please try again later.</p>";
    }
}
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="feedback">
    <h1>Submit you feedback</h1>
    <h2>If you have any complaints, please contact us</h2>
    <form method="post">
        <div class="mb-3">
            <label for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname"><br>
            <div class="mb-3">
            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname"><br><br>
            <textarea name="msg" placeholder="Feedback" style="resize: none;" required></textarea><br><br>
            <label for="email">Email address:</label><br>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            <input type="email" name="email" required placeholder="Enter a valid email address"><br><br>
        </div>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="gender" value="other">
        <label for="other">Other</label><br><br>
        <label for="website">How did you find us?</label>
        <select id="website" name="website">
        <option value="empty"></option>
        <option value="instagram">Instagram</option>
        <option value="facebook">Facebook</option>
        <option value="google">Google</option>
        <option value="tiktok">TikTok</option>
        <option value="other">Other</option></select><br><br>
        <label for="msg">If you selected other:</label><br>
        <textarea name="msg" placeholder="Message" style="resize: none;" required></textarea><br><br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</div>
    <span></span>
<?php
include('footer.php');
?>