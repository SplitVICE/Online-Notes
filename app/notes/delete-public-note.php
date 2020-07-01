<?php

require '../database/delete.php';

$note_id = $_GET['note_id'];

delete_public_note($note_id);
