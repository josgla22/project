<?php
include_once('template.php');
include_once('accessLog.php');
$conn = new mysqli($host, $user, $pwd, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['distance'];
    $goal_type = $_POST['goal_type'];
    $goaltype_id = null;

    $stmt = $conn->prepare("SELECT goaltype_id FROM goaltype WHERE value = ?");
    if (!$stmt) {
        die("Error preparing SQL statement: " . $conn->error);
    }
    $stmt->bind_param("s", $goal_type);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $goaltype_id = $row['goaltype_id'];
    }

    $email = $_SESSION['email']; 
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $stmt = $conn->prepare("INSERT INTO goal (value, goaltype_id, user_id) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE value = ?");
    $stmt->bind_param("isii", $value, $goaltype_id, $user_id, $value);
    if ($stmt->execute()) {
        mysqli_close($conn);
    } else {
        echo "Error: " . $stmt->error;
        mysqli_close($conn);
    }
}
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="tracker">
    <h1>Reach your goals!</h1>
    <p>
    We all have dreams and aspirations, but without setting clear goals, those dreams are just wishes. Goals are what transform those dreams into achievable objectives that we can work towards.
    Setting goals can be a daunting task, but it is crucial to take the time to define them properly. Think about what you want to achieve, both short-term and long-term, and write them down. By setting clear and specific goals, you give yourself direction and focus, which can help you to stay motivated.
    <br><br>
    But setting goals is only the first step. It's what you do next that truly matters. Reaching your goals requires hard work, discipline, and determination. You need to be willing to push yourself outside of your comfort zone and take action every day.
    You may face obstacles along the way, but remember that setbacks are a natural part of the journey. It's how you respond to those setbacks that will define your success. Use them as an opportunity to learn and grow, and keep pushing forward.
    <br><br>Don't forget to celebrate your successes along the way. Reaching your goals takes time and effort, and you deserve to be proud of yourself for every step you take towards achieving them. Set clear goals for yourselves, work hard, and never give up. Remember that the only limits you have are the ones you set for yourself. Believe in yourself and your ability to achieve your dreams, and you will see that anything is possible!</br>
</div>
<div class="box">
    <h1 class="heading1">Personal goals</h1>
    <form method="post" action="goal.php">
        <select name="goal_type" id="goal_type">
            <option value="steps">Steps</option>
            <option value="walked_distance">Walked distance</option>
            <option value="cycled_distance">Cycled distance</option>
            <option value="bedtime">Bedtime</option>
            <option value="calorie">Calories</option>
            <option value="sleeping_hours">Sleeping hours</option>
            <option value="weight">Weight</option>
            <option value="get_up_time">Get up time</option>
        </select>
        <input type="text" name="distance" placeholder="Steps" id="distance_input"><br>
        <input type="submit" value="Add Goal">
        <input type="reset" value="Reset">
    </form>
</div>
<script>
    var distanceInput = document.getElementById("distance_input");
    var goalTypeSelect = document.getElementById("goal_type");
    goalTypeSelect.addEventListener("change", function() {
        if (goalTypeSelect.value === "steps") {
            distanceInput.placeholder = "Steps";
        } else if (goalTypeSelect.value === "walked_distance") {
            distanceInput.placeholder = "Meters";
        } else if (goalTypeSelect.value === "cycled_distance") {
            distanceInput.placeholder = "Meters";
        } else if (goalTypeSelect.value === "calorie") {
            distanceInput.placeholder = "Kcal";
        } else if (goalTypeSelect.value === "weight") {
            distanceInput.placeholder = "Kg";
        } else if (goalTypeSelect.value === "bedtime") {
            distanceInput.placeholder = "hh:mm:ss";
        } else if (goalTypeSelect.value === "sleeping_hours") {
            distanceInput.placeholder = "hh:mm:ss";
        } else if (goalTypeSelect.value === "get_up_time") {
            distanceInput.placeholder = "hh:mm:ss";
        }
    });
</script>
<?php
include('footer.php');
?>