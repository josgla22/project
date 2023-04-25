<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['distance'];
    $goal_type = $_POST['goal_type'];
    $goaltype_id = null;

    // Find the goaltype_id for the selected goal type
    $stmt = $conn->prepare("SELECT goaltype_id FROM goaltype WHERE goaltype = ?");
    if (!$stmt) {
        die("Error preparing SQL statement: " . $conn->error);
    }
    $stmt->bind_param("s", $goal_type);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $goaltype_id = $row['goaltype_id'];
    }

    // Insert the new goal into the goal table
    $stmt = $conn->prepare("INSERT INTO goal (value, goaltype_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $value, $goaltype_id);
    if ($stmt->execute()) {
        echo "Goal added";
    } else {
        echo "Error: " . $stmt->error;
    }
    mysqli_close($conn);
}

$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="box">
    <h1>Personal Goals</h1>
    <form method="post" action="goal.php">
        <select name="goal_type" id="goal_type">
            <option value="steps">Steps</option>
            <option value="walked_distance">Walked distance</option>
            <option value="cycled_distance">Cycled distance</option>
            <option value="bedtime">Bedtime</option>
            <option value="calorie">Calories</option>
            <option value="sleepingHours">Sleeping hours</option>
            <option value="Weight">Weight</option>
            <option value="GetUpTime">Get up time</option>
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
            distanceInput.placeholder = "Walked distance";
        } else if (goalTypeSelect.value === "cycled_distance") {
            distanceInput.placeholder = "Cycled distance";
        } else if (goalTypeSelect.value === "calorie") {
            distanceInput.placeholder = "Calories";
        } else if (goalTypeSelect.value === "Weight") {
            distanceInput.placeholder = "kg";
        } else if (goalTypeSelect.value === "bedtime") {
            distanceInput.placeholder = "hh:mm:ss";
        } else if (goalTypeSelect.value === "sleepingHours") {
            distanceInput.placeholder = "hh:mm:ss";
        } else if (goalTypeSelect.value === "GetUpTime") {
            distanceInput.placeholder = "hh:mm:ss";
        }
    });
</script>
<?php
include('footer.php');
?>