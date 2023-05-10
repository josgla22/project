<?php
include_once('template.php');
include_once('accessLog.php');
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="tracker">
    <h1>Track Your Achivements</h1>
    <p>Welcome to the Health Dashboard!
    <br><br>We're excited to have you here and can't wait to help you reach your fitness goals. This dashboard is designed to help you track your progress and stay accountable for your daily workouts. By submitting your workout results every day, you'll be able to see how far you've come and what you need to do to keep pushing forward.
    <br><br>To submit your daily workout results, simply click on the "Submit Results" button and fill out the form. You can enter details such as the type of exercise you did, the duration of your workout, the number of reps or sets you completed, and any notes or comments you want to add. Be as detailed as possible, so you can get the most out of this dashboard and see the progress you're making.
    <br><br>Remember, consistency is key when it comes to working out. By committing to submitting your workout results every day, you'll be building healthy habits that will benefit you in the long run. So, let's get started and make today a great day for your health and fitness journey!</p>
</div>
<?php
include('steps.php');
?>
<?php
include('weight.php');
?>
<?php
include('walked_distance.php');
?>
<?php
include('cycled_distance.php');
?>
<?php
include('bedTime.php');
?>
<?php
include('getUpTime.php');
?>
<?php
include('daytimeNaps.php');
?>
<?php
include('sleepingHours.php');
?>
<?php
include('calorie.php');
?>
<?php
include('footer.php');
?>