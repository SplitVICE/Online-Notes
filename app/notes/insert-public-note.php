<?php

require '../database/create.php';

$note_title = $_POST['note_title'];
$note_description = $_POST['note_description'];

if ($note_title == "")
    $note_title = "Untitled note";

if ($note_description != " ")
    insert_public_note($note_title, $note_description);

$url = "../../";
header('Location: ' . $url);
