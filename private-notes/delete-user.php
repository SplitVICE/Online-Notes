<?php

require "../memory.php";
require "../app/tasks.php";
require "../app/database/delete.php";
require "../app/database/read.php";

$user_data = bring_user_data_by_cookie_sessionToken();

delete_user($user_data["user_id"]);
delete_associated_notes($user_data["user_id"]);
delete_all_sessions_user_request_or_account_delete();

setcookie("sessionToken", "", time() - 3600, "/");

$url = "../response/account-deleted/";
header('Location: ' . $url);
