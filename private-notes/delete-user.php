<?php

require "../memory.php";
require "../app/database/delete.php";

$user_id = $_SESSION['user_id'];

delete_user($user_id);
delete_associated_notes($user_id);

$_SESSION['user_logged_in'] = false;
$_SESSION['user_id'] = "n/a";
$_SESSION['user_username'] = "n/a";

$url = "../response/index.php?message=Your account was successfully deleted";
header('Location: ' . $url);

?>