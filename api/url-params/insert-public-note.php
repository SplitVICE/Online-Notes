<?php
// API to save a new public note using website's URL.
// Requires URL parameters -> note-description & note-title .
// note-title parameter is optional.
// onlinenotes.vice/api/url-params/insert-public-note.php?note-description="nteDesc"&note-title="nteTitle"
require "../../app/database/create.php";
require "../../app/tasks.php";
$response = array();
if (isset($_GET['note-description'])) {
    $note_title = "Untitled note";
    $note_description = $_GET['note-description'];
    if (isset($_GET['note-title'])) {
        if ($_GET['note-title'] != "")
            $note_title = $_GET['note-title'];
    }
    if (insert_public_note_api($note_title, $note_description)) {
        $response['status'] = "success";
        $response['description'] = "note has been saved";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    } else {
        $response['status'] = "failed";
        $response['description'] = "internal database error";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    }
} else {
    $response['status'] = "failed";
    $response['description'] = "note description not given";
    echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
}
