<?php

//Route: onlinenotes.ml/json/insert-public-note.php
//JSON template:
/*
{
    "title":"JSON API NOTE",
    "description":"This public note was registered from JSON"
}
*/

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input")); //Gets data from request JSON.

$title = $data->title;
$description = $data->description;

if ($description != "") {

    if($title == ""){ // If title not given, "Untitled note" is given as title.
        $title = "Untitled note";
    }

    require "../../app/database/create.php";
    require "../../memory.php";

    if (insert_public_note_rest_api($title, $description)) {//Note has been saved.
        echo json_encode( 
            array("status" => "success", "description" => "note has been saved")
        );
    } else { // Error: internal database error.
        echo json_encode(
            array("status" => "failed", "description" => "Error 500")
        );
    }
} else { // Error: description not given.
    echo json_encode(
        array("status" => "failed", "description" => "note description not given")
    );
}
