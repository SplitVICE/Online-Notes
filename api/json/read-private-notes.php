<?php

//Route: onlinenotes.vice/api/json/read-private-notes.php
//JSON template:
/*
{
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

if (isset($data)) {
    $username = $data->username;
    $pass = $data->pass;

    if (credentials_given($username, $pass)) {

        $user_status = credentialsValid_giveID($username, $pass);

        if ($user_status["status"] == "true") {
            $user_id = check_credentials_return_id_api($username, $pass);
            $private_notes = fetch_private_notes_by_user_id_given($user_id["ID"]);
            echo json_encode($private_notes, JSON_PRETTY_PRINT);
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
}else{
    echo json_encode(array("status" => "failed", "description" => "user data not given"));
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
    $obj = check_credentials_return_id_json_api($username, $pass);

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
