<?php

require '../database/mysql.php';

$note_id = $_GET['note_id'];

echo $note_id;

delete_private_note($note_id);
