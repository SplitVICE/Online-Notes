<?php
// onlinenotes.vice/api/read-public-notes
require "../../memory.php";
require "../../app/database/read.php";
$public_notes_array = fetch_public_notes_for_api();
echo json_encode($public_notes_array);
