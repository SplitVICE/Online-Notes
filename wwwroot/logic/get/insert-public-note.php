<?php

require '../database/mysql.php';

$note_title = $_GET['note_title'];
$note_description = $_GET['note_description'];

if ($note_title == '') {
    $note_title = "Untitled note";
}

insert_public_note($note_title, $note_description);
