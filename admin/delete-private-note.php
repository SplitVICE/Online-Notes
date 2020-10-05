<?php

require "../memory.php";
require "../app/database/delete.php";

if ($_SESSION['admin_logged_in'] == true) {
    $note_id_to_delete = $_GET['note_id'];
    echo "Delete note: " . $note_id_to_delete;
    delete_note_admin($note_id_to_delete);
    $url = "./index.php";
    header('Location: ' . $url);
} else {
    $url = "/";
    header('Location: ' . $url);
}