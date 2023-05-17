<?php
include_once('template.php');
include_once('accessLog.php');
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
    $to = 'healtdashboard123453434234@hotmail.com'; 
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
<div class="login-form">
    <h1>Submit your feedback</h1>
    <p>If you have any complaints, please contact us in the form below:</p>
    <form method="post">
        <div class="input-wrapper">
            <input type="text" id="fname" name="fname" placeholder="Firs tname"><br>
        </div>
        <div class="input-wrapper">
            <input type="text" id="lname" name="lname" placeholder="Last name"><br>
        </div>
        <div class="input-wrapper">
            <input type="email" name="email" required placeholder="Email"><br>
        </div>
        <div class="input-wrapper">
            <textarea name="msg" placeholder="Feedback" style="resize: none;" required></textarea><br>
        </div>
        <div class="input-wrapper">
            <label for="gender">Gender:</label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Other</label><br>
        </div>
        <div class="input-wrapper">
            <label for="website">How did you find us?</label><br>
            <select id="website" name="website">
                <option value="empty"></option>
                <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
                <option value="google">Google</option>
                <option value="tiktok">TikTok</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="input-wrapper">
            <label for="msg_other">If you selected other:</label><br>
            <textarea name="msg_other" placeholder="Message" style="resize: none;" required></textarea>
        </div>
        <button type="submit">Submit</button>
        <button type="reset">Reset</button><br><br>
    </form>
</div>
    <span></span>
<?php
include('footer.php');
?>