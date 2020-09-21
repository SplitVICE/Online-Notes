<?php

require "../app/database/delete.php";
require "../memory.php";
require "../app/tasks.php";

delete_session_register_by_user_logout();

setcookie("sessionToken", "", time() - 3600, "/");

$url = "../";
header('Location: ' . $url);
