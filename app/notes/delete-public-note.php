<?php

require '../database/mysql.php';

$note_id = $_GET['note_id'];

echo $note_id;

delete_public_note($note_id);
