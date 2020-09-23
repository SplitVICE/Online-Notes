<?php

require "../app/database/delete.php";
require "../memory.php";
require "../app/tasks.php";

delete_session_register_by_user_logout();

delete_cookie_sessionToken();

$url = "../";
header('Location: ' . $url);
