<?php
// Deletes all private notes from an user ID passed.

require "../memory.php";
require "../app/database/delete.php";

if ($_SESSION['admin_logged_in'] == true) {
    $notesOwnerIDToDelete = $_GET['account_id'];
    delete_associated_notes($notesOwnerIDToDelete);
    $url = "./index.php";
    header('Location: ' . $url);
} else {
    $url = "./index.php";
    header('Location: ' . $url);
}