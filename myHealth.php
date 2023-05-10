<?php
include_once('template.php');
include_once('accessLog.php');
$content = <<<END
END;
echo $navigation;
echo $content;
?>
<div class="tracker">
    <h1>Activity overview</h1>
    <p>Track your progress and achieve your health goals with our activity results feature! 
    Get insights into your performance and see how close you are to reaching your targets. Our personal website is designed to help you track your activity goals with ease. 
    <br>With our activity results feature, you can keep track of your progress and see how far you've come in achieving your health goals. 
    <br><br>Stay motivated and on track with our user-friendly dashboard. 
    <br>Start achieving your health goals today!</p>
</div>
<div class="box">
    <h1 class="heading1">Steps progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];


    $sql = "SELECT value FROM goal WHERE goaltype_id = 1 and user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $goal = $row["value"];
            echo "<tr><td>Step goals: " . number_format($goal) . " steps</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No goals added</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM steps WHERE date = CURDATE() and user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $currentSteps = $row["value"];
            echo "<tr><td>Current Steps: </td><td>" . number_format($currentSteps) . " steps</td></tr><br>";
        }
        if (isset($goal)) {
            $remaining = $goal - $currentSteps;
            echo "<tr><td>Remaining Steps: </td><td>" . number_format($remaining) . " steps</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Walked progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM goal WHERE goaltype_id = 7 and user_id = $user_id";
    $walkresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($walkresult) > 0) {
        while ($row = mysqli_fetch_assoc($walkresult)) {
            $walkgoal = $row["value"];
            echo "<tr><td>Walked goals: " . number_format($walkgoal) . " km</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No goals added</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM walked_distance WHERE date = CURDATE() and user_id = $user_id";
    $walkresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($walkresult) > 0) {
        while ($row = mysqli_fetch_assoc($walkresult)) {
            $currentwalk = $row["value"];
            echo "<tr><td>Current distance: </td><td>" . number_format($currentwalk) . " km</td></tr><br>";
        }
        if (isset($walkgoal)) {
            $remainingwalk = $walkgoal - $currentwalk;
            echo "<tr><td>Remaining distance: </td><td>" . number_format($remainingwalk) . " km</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }

    mysqli_close($conn);    
    ?>
</div>
<div class="box">
    <h1 class="heading1">Cycled progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM goal WHERE goaltype_id = 9 and user_id = $user_id";
    $cycledresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($cycledresult) > 0) {
        while ($row = mysqli_fetch_assoc($cycledresult)) {
            $cycledgoal = $row["value"];
            echo "<tr><td>Cycled goal: " . number_format($cycledgoal) . " km</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No goals added</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM cycled_distance WHERE date = CURDATE() and user_id = $user_id";
    $cycledresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($cycledresult) > 0) {
        while ($row = mysqli_fetch_assoc($cycledresult)) {
            $currentcycled = $row["value"];
            echo "<tr><td>Current distance: </td><td>" . number_format($currentcycled) . " km</td></tr><br>";
        }
        if (isset($cycledgoal)) {
            $remainingcycled = $cycledgoal - $currentcycled;
            echo "<tr><td>Remaining distance: </td><td>" . number_format($remainingcycled) . " km</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Sleeping progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];


    $sql = "SELECT value FROM goal WHERE goaltype_id = 9 and user_id = $user_id";
    $sleepresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sleepresult) > 0) {
        while ($row = mysqli_fetch_assoc($sleepresult)) {
            $sleepgoal = $row["value"];
            echo "<tr><td>Sleeping goal: " . number_format($sleepgoal) . " hours</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No goals added</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM sleeping_hours WHERE date = CURDATE() and user_id = $user_id";
    $sleepresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sleepresult) > 0) {
        while ($row = mysqli_fetch_assoc($sleepresult)) {
            $currentsleep = $row["value"];
            echo "<tr><td>Current distance: </td><td>" . number_format($currentsleep) . " hours</td></tr><br>";
        }
        if (isset($sleepgoal)) {
            $remainingsleep = $sleepgoal - $currentsleep;
            echo "<tr><td>Remaining: </td><td>" . number_format($remainingsleep) . " hours</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Weight progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM goal WHERE goaltype_id = 8 and user_id = $user_id";
    $weightresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($weightresult) > 0) {
        while ($row = mysqli_fetch_assoc($weightresult)) {
            $weightgoal = $row["value"];
            echo "<tr><td>Weight goal: " . number_format($weightgoal) . " kg</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No data found</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM weight WHERE date = CURDATE() and user_id = $user_id";
    $weightresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($weightresult) > 0) {
        while ($row = mysqli_fetch_assoc($weightresult)) {
            $currentweight = $row["value"];
            echo "<tr><td>Current weight: </td><td>" . number_format($currentweight) . " kg</td></tr><br>";
        }
        if (isset($weightgoal)) {
            $remainingweight = $weightgoal - $currentweight;
            echo "<tr><td>Remaining: </td><td>" . number_format($remainingweight) . " kg</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Calorie progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM goal WHERE goaltype_id = 3 and user_id = $user_id";
    $calorieresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($calorieresult) > 0) {
        while ($row = mysqli_fetch_assoc($calorieresult)) {
            $caloriegoal = $row["value"];
            echo "<tr><td>Calorie goal: " . number_format($caloriegoal) . " kcal</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No data found</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM calorie WHERE date = CURDATE() and user_id = $user_id";
    $calorieresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($calorieresult) > 0) {
        while ($row = mysqli_fetch_assoc($calorieresult)) {
            $currentcal = $row["value"];
            echo "<tr><td>Current calories: </td><td>" . number_format($currentcal) . " kcal</td></tr><br>";
        }
        if (isset($caloriegoal)) {
            $remainingcal = $caloriegoal - $currentcal;
            echo "<tr><td>Remaining: </td><td>" . number_format($remainingcal) . " kcal</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Wake up progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM goal WHERE goaltype_id = 5 and user_id = $user_id";
    $getupresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($getupresult) > 0) {
        while ($row = mysqli_fetch_assoc($getupresult)) {
            $getupgoal = $row["value"];
            echo "<tr><td>Get up goal: " . number_format($getupgoal) . " am</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No data found</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM get_up_time WHERE date = CURDATE() and user_id = $user_id";
    $getupresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($getupresult) > 0) {
        while ($row = mysqli_fetch_assoc($getupresult)) {
            $currentgetup = $row["value"];
            echo "<tr><td>Current time: </td><td>" . number_format($currentgetup) . " am</td></tr><br>";
        }
        if (isset($getupgoal)) {
            $remaininggetup = $getupgoal - $currentgetup;
            echo "<tr><td>Remaining: </td><td>" . number_format($remaininggetup) . " hour</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Bedtime progress</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM goal WHERE goaltype_id = 2 and user_id = $user_id";
    $bedresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($bedresult) > 0) {
        while ($row = mysqli_fetch_assoc($bedresult)) {
            $bedgoal = $row["value"];
            echo "<tr><td>Bedtime goal: " . number_format($bedgoal) . " pm</td></tr><br>";
        }
    } else {
    echo "<tr><td colspan='1'>No data found</td></tr><br>";
    }
    // Get current steps
    $sql = "SELECT value FROM bedtime WHERE date = CURDATE() and user_id = $user_id";
    $bedresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($bedresult) > 0) {
        while ($row = mysqli_fetch_assoc($bedresult)) {
            $currentbed = $row["value"];
            echo "<tr><td>Current time: </td><td>" . number_format($currentbed) . " pm</td></tr><br>";
        }
        if (isset($bedgoal)) {
            $remainingbed = $bedgoal - $currentbed;
            echo "<tr><td>Remaining: </td><td>" . number_format($remainingbed) . " hour</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No goals added</td></tr><br>";
    }
    mysqli_close($conn);
?>
</div>
<div class="box">
    <h1 class="heading1">Daytime naps</h1>
    <?php
    $conn = new mysqli($host, $user, $pwd, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['email']; // assuming the user's email address is stored in a session variable
    $user_query = "SELECT user_id FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $user_query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $sql = "SELECT value FROM daytime_naps WHERE date = CURDATE() and user_id = $user_id";
    $bedresult = mysqli_query($conn, $sql);
    if (mysqli_num_rows($bedresult) > 0) {
        while ($row = mysqli_fetch_assoc($bedresult)) {
            $currentbed = $row["value"];
            echo "<tr><td>Current time: </td><td>" . number_format($currentbed) . " hours</td></tr><br>";
        }}
    mysqli_close($conn);
?>
</div>
<?php
include('footer.php');
?>
