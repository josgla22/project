<?php
include_once('template.php');
$conn = new mysqli($host, $user, $pwd, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addLogData() {
	global $conn;

	$uagent = $_SERVER['HTTP_USER_AGENT'];

	# Get browser name
	if(strpos($uagent, 'MSIE') !== false)
		$browser = 'Internet Explorer';
	elseif(strpos($uagent, 'Trident') !== false)
		$browser = 'Internet Explorer';
	elseif(strpos($uagent, 'Firefox') !== false)
		$browser = 'Mozilla Firefox';
	elseif(strpos($uagent, 'Edge') !== false)
		$browser = 'Microsoft Edge';
	elseif(strpos($uagent, 'Chrome') !== false)
		$browser = 'Google Chrome';
	elseif(strpos($uagent, 'Opera') !== false)
		$browser = "Opera";
	elseif(strpos($uagent, 'Safari') !== false)
		$browser = "Safari";
	else
		$browser = 'Other';

	# Get client IP address and request time and URI
	$ip = $_SERVER['REMOTE_ADDR'];
	$uri = $_SERVER['REQUEST_URI'];

	$query = "INSERT INTO access_log (ip_address, browser, page) VALUES ('{$ip}', '{$browser}', '{$uri}')";
	$result = $conn->query($query);

	# Get last accesslog_id
	$accesslog_id = $conn->insert_id;

if (isset($_SESSION['email'])) {
	$email = $_SESSION['email']; 
	$user_query = "SELECT user_id FROM user WHERE email = '$email'";
	$result = mysqli_query($conn, $user_query);
	$row = mysqli_fetch_assoc($result);
	$user_id = $row['user_id'];
}
	
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
	$query = "INSERT INTO user_access (accesslog_id, user_id) VALUES ('{$accesslog_id}', '{$user_id}')";
	$result = $conn->query($query);
} else {
	// handle the case where the user is not logged in
}
}

addLogData(); // call the function to add log data and user access
?>