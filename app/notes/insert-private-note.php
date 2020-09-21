<?php

require "../../memory.php";
require "../tasks.php";
require "../database/read.php";
require "../database/create.php";
require "../database/delete.php";
require "../database/update.php";

$note_title = $_GET['note_title'];
$note_description = $_GET['note_description'];

if ($note_title == '') {
    $note_title = "Untitled note";
}

insert_private_note($note_title, $note_description);
