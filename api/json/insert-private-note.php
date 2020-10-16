<?php

//Route: onlinenotes.vice/api/json/insert-private-note.php
//JSON template:
/*
{
    "title":"JSON API NOTE",
    "description":"This private note was registered from API JSON",
    "username":"yourUsername",
    "pass":"yourPassword"
}
*/

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/create.php";
require "../../app/database/read.php";

$data = json_decode(file_get_contents("php://input")); //Gets data from request JSON.

if (isset($data->description) && isset($data->username) && isset($data->pass)) {
    $title = "";
    if (isset($data->title)) $title = $data->title;
    $description = $data->description;
    $username = $data->username;
    $pass = $data->pass;

    if (
        description_given($description) &&
        credentials_given($username, $pass)
    ) {
        $user_status = credentialsValid_giveID($username, $pass);
        if ($user_status != null) {
            if ($title == "") { // If title not given, "Untitled note" is given as title.
                $title = "Untitled note";
            }

            if (insert_private_note_rest_api($title, $description, $user_status["ID"])) { //Note has been saved.
                echo json_encode(
                    array("status" => "success", "description" => "private note has been saved")
                );
            } else { //Error: internal database error.
                echo json_encode(
                    array("status" => "failed", "description" => "internal database error")
                );
            }
        } else {
            if ($user_status == null) { //Password incorrect.
                echo json_encode(
                    array("status" => "failed", "description" => "credentials incorrect")
                );
            }
        }
    }
} else {
    echo json_encode(
        array("status" => "failed", "description" => "missing required JSON keys")
    );
}

function description_given($description)
{
    if ($description != "") {
        return true;
    }
    echo json_encode(
        array("status" => "failed", "description" => "note description not given")
    );
    return false;
}

function credentials_given($username, $pass)
{
    if ($username != "" && $pass != "") {
        return true;
    }
    echo json_encode(
        array("status" => "failed", "description" => "credentials not given")
    );
    return false;
}

function credentialsValid_giveID($username, $pass)
{
    $return_obj = array("status" => "false", "ID" => "no record found");
    $obj = check_credentials_return_id_api($username, $pass);

    if ($obj['ID'] == "NA") {
        return null;
    }

    if ($obj['ID'] == "no record found") {
        return null;
    }
    $return_obj["ID"] = $obj["ID"];
    return $return_obj;
}
