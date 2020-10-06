<?php
// API to save a new public note using website's URL.
// Requires URL parameters -> note-description & note-title .
// note-title parameter is optional.

require "../../app/database/create.php";

$response = array();

if (isset($_GET['note-description'])) {

    $note_title = "";
    $note_description = $_GET['note-description'];

    if (!isset($_GET['note-title'])) {
        $note_title = "Untitled note";
    } else {
        if ($_GET['note-title'] != "") {
            $note_title = $_GET['note-title'];
        } else {
            $note_title = "Untitled note";
        }
    }

    if(insert_public_note_api($note_title, $note_description)){
        $response['status'] = "success";
        $response['description'] = "note has been saved";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    }else{
        $response['status'] = "failed";
        $response['description'] = "internal database error";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    }
    
} else {
    $response['status'] = "failed";
    $response['description'] = "note description not given";
    echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
}
