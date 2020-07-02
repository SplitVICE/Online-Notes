<?php

require "../memory.php";
require "../app/database/delete.php";

if ($_SESSION['admin_logged_in'] == true) {
    $user_to_delete_id = $_GET['account_id'];
    echo "Delete note: " . $note_id_to_delete;
    delete_user($user_to_delete_id);
    delete_associated_notes($user_to_delete_id);
    $url = "/dashboard";
    header('Location: ' . $url);
} else {
    $url = "/";
    header('Location: ' . $url);
}