<?php
require "../tasks.php";
require '../database/delete.php';
require '../database/read.php';
require "../../memory.php";

$note_id = $_GET['note_id'];

delete_private_note($note_id);
