<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send</title>
    <link rel="stylesheet" property="stylesheet" type="text/css" href="css/stylesheet.css" />
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
        <a href="tracker.php">TRACKER</a>
        <a href="index.php">HOME</a>
        <a href="about.php">ABOUT US</a>
        <a href="register.php">REGISTER</a>
        <a href="contact.php">CONTACT</a>
        <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
END;

    if (isset($_SESSION['user_id']))
    {
        $navigation .= <<<END
        <a href="logout.php">LOGOUT</a>
        <a href="myHealth.php">MY PAGE</a>

END;
        if ($_SESSION['is_admin'] === '1') {
            $navigation .= '';
        }
        $navigation .= 'Logged in as ' . $_SESSION['email'];
    }
    else
    {
        $navigation .= <<<END
        <a href="login.php">LOG IN</a>
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