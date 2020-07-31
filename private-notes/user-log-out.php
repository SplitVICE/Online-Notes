<?php

require "../memory.php";

$_SESSION['user_logged_in'] = false;
$_SESSION['user_id'] = "n/a";
$_SESSION['user_username'] = "n/a";

$url = "../";
header('Location: ' . $url);
