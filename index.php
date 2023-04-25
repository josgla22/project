<?php
include('template.php');
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="wrapper">
    <div class="centered">
        <h1>HeartBeat</h1><br><br>
        <p>Welcome to our health app!<br>
        We're here to help you live a healthier life.
        Register now and take control of your health. With our app, you can track your activity, such as steps, calories, and distance.
        You'll also receive personalized feedback and encouragement to help you achieve your health goals.
        Join our healthy community today by signing up!</p>
        <button><a href="register.php">REGISTER</a></button>
    </div>
</div>
<?php
include('footer.php');
?>