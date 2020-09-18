<?php

require '../app/database/delete.php';

$note_id = $_GET['note_id'];

delete_public_note_admin($note_id);
