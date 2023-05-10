<?php
include_once('template.php');
include_once('accessLog.php');
$_SESSION = array();
session_destroy();
header("Location:index.php");
include('footer.php');
?>