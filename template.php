<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send</title>
    <link rel="stylesheet" property="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
    session_name('Website');
    session_start();
    $host = "localhost";
    $user = "josgla22"; 
    $pwd = "_fLhYXqDRB"; 
    $db = "josgla22_db"; 
    $mysqli = new mysqli($host, $user, $pwd, $db);
    $navigation = <<<END
    <nav class="topnav">
        <div class="dropdown">
            <button class="dropbtn">TRACKER 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="steps.php">Steps</a>
                <a href="walked_distance.php">Walked Distance</a>
                <a href="cycled_distance.php">Cycled Distance</a>
                <a href="cycled_distance.php">Cycled Distance</a>
                <a href="cycled_distance.php">Cycled Distance</a>
                <a href="sleepingHours.php">Cycled Distance</a>
                <a href="goal.php">Workout Goals</a>
            </div>
        </div> 
        <a href="index.php">HOME</a>
        <a href="about.php">ABOUT US</a>
        <a href="register.php">REGISTER</a>
        <a href="register.php">CONTACT</a>
        <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
END;

    if (isset($_SESSION['userId']))
    {
        $navigation .= <<<END
        <a href="logout.php">LOGOUT</a>
END;
        if ($_SESSION['username'] === 'admin') {
            $navigation .= '<a href="add_product.php">Add Product</a>';
        }
        $navigation .= 'Logged in as ' . $_SESSION['username'];
    }
    else
    {
        $navigation .= <<<END
        <a href="login.php">LOG IN</a>
END;
    }
    $navigation .= '</nav>';
    ?>