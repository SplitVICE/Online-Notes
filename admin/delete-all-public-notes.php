<?php

require "../app/database/delete.php";
require "../memory.php";

if ($_SESSION['admin_logged_in'] == true) {
    echo "Public notes deleted";
    delete_all_public_notes();
    $url = "./index.php";
    header('Location: ' . $url);
} else {
    $url = "/";
    header('Location: ' . $url);
}