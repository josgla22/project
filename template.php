<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send</title>
    <link rel="stylesheet" property="stylesheet" type="text/css" href="css/stylesheet.css" />
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
        <a href="index.php">HOME</a>
        <a href="about.php">ABOUT US</a>
        <a href="contact.php">CONTACT</a>
END;
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === '1') {
    $navigation .= '<a href="analytics.php">ANALYTICS</a>';
    $navigation .= '<a href="edit.php">MANAGE USERS</a>';
    }
    else {
        if (!isset($_SESSION['user_id'])) {
        $navigation .= <<<END
        <a href="register.php">REGISTER</a>
        <a href="login.php">LOG IN</a>
        
END;
    }
}
if (isset($_SESSION['user_id']))
{
    $navigation .= <<<END
    <div class="dropdown">
        <button class="dropbtn">
            <i class="fa fa-caret-down"></i>
        </button>
    <div class="dropdown-content">
        <a href="myHealth.php">MY PAGE</a>
        <a href="goal.php">MY GOALS</a>
        <a href="tracker.php">TRACKER</a>
        <a href="logout.php">SIGN OUT</a>
        </div>
        </div>
END;
}
    $navigation .= '</nav>';
    ?>
 <script>
    const form = document.getElementById('search-form');
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // prevent the default form submission
        const query = form.search.value; // get the search query from the input field
          // send the search query to the server using fetch or XMLHttpRequest
          // display the search results on the page
    });
 </script>