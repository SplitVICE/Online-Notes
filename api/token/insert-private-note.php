<?php

//Route: onlinenotes.vice/api/token/insert-private-note.php
//JSON template:
/*
{
    "title":"Note Title",
    "description":"This is a private note inserted with API Connection Token.",
    "token":"yourToken"
}
*/

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/create.php";
require "../../app/database/read.php";

$data = json_decode(file_get_contents("php://input")); // Gets data from request JSON.

if (isset($data->token)) {
    $token = $data->token;
    if (isset($data->description)) {
        $description = $data->description;
        $title = fetch_title($data);
        if (
            descriptionNotEmpty($description) &&
            tokenNotEmpty($token)
        ) {
            $user_id = tokenValid_returnUserId($token);
            if ($user_id != null) {
                if (tokenHasPublishPermission($token)) {
                    if ($title == "") {
                        $title = "Untitled note";
                    }
                    if (insert_private_note_rest_api($title, $description, $user_id)) {
                        echo json_encode(
                            array("status" => "success", "description" => "private note has been saved")
                        );
                    } else {
                        echo json_encode(
                            array("status" => "failed", "description" => "error 500")
                        );
                    }
                }
            }
        }
    } else {
        echo json_encode(
            array("status" => "failed", "description" => "note description not given")
        );
    }
} else {
    echo json_encode(
        array("status" => "failed", "description" => "token not given")
    );
}

// Checks if description JSON key's value has content.
function descriptionNotEmpty($description)
{
    if ($description != "") {
        return true;
    }
    echo json_encode(
        array("status" => "failed", "description" => "note description not given")
    );
    return false;
}

function tokenNotEmpty($token)
{
    if ($token != "") {
        return true;
    }
    echo json_encode(
        array("status" => "failed", "description" => "token not given")
    );
    return false;
}

// Checks if the token is valid.
// If valid, returns user's ID.
// If not valid, prints error code.
function tokenValid_returnUserId($token)
{
    $return_obj = array("status" => "failed", "description" => "token not valid");
    $obj = api_connection_token_brind_id_if_exists($token);

    if ($obj == null) {
        echo json_encode(
            $return_obj
        );
        return null;
    } else {
        return $obj["user_id"];
    }
}

// Returns true if so. Prints error if no read permission.
function tokenHasPublishPermission($token)
{
    $tokenPermissions = apiConnectionToken_bringPermissionDetails($token);
    if ($tokenPermissions["PublishPermission"] == 1) return true;
    else {
        echo json_encode(
            array("status" => "failed", "description" => "publish permission disallowed")
        );
        return null;
    }
}

// Returns title string. Returns "Untitled note" if not given.
function fetch_title($data)
{
    if (isset($data->title))
        return $data->title;
    else
        return "Untitled note";
}
