<?php

require "../memory.php";
require "../app/tasks.php";
require "../app/database/delete.php";

if ($_SESSION['admin_logged_in'] == true) {
    $user_to_delete_id = $_GET['account_id'];
    delete_user_sessions_admin($user_to_delete_id);
    delete_user($user_to_delete_id);
    delete_associated_notes($user_to_delete_id);
    delete_api_connection_token_UserId($user_to_delete_id);
    $url = "./index.php";
    header('Location: ' . $url);
} else {
    $url = "./index.php";
    header('Location: ' . $url);
}