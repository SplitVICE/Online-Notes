<?php

//Route: onlinenotes.vice/api/rest/insert-public-note/index.php
//JSON template:
/*
{
    "title":"REST API NOTE",
    "description":"This private note was registered from API REST",
    "username":"yourUsername",
    "pass":"yourPassword"
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
$username = $data->username;
$pass = $data->pass;

if (
    description_given($description) &&
    credentials_given($username, $pass)
) {

    $user_status = credentialsValid_giveID($username, $pass);

    if ($user_status["status"] == "true") {
        if ($title == "") { //If title not given, "Untitled note" is given as title.
            $title = "Untitled note";
        }

        require "../../../app/database/create.php";

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
        if ($user_status["ID"] == "NA") { //Password incorrect.
            echo json_encode(
                array("status" => "failed", "description" => "password is incorrect")
            );
        }
        if ($user_status["ID"] == "no record found") { // User was not found.
            echo json_encode(
                array("status" => "failed", "description" => "username does not exist")
            );
        }
    }
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
    require "../../../app/database/read.php";

    $return_obj = array("status" => "false", "ID" => "no record found");
    $obj = check_credentials_return_id_rest_api($username, $pass);

    if ($obj['ID'] == "NA") {
        $return_obj["ID"] = "NA";
        return $return_obj;
    }

    if ($obj['ID'] == "no record found") {
        return $return_obj;
    }

    $return_obj["status"] = "true";
    $return_obj["ID"] = $obj["ID"];

    return $return_obj;
}
