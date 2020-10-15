<?php

//Route: onlinenotes.vice/api/token/delete-private-note.php
//JSON template:
/*
{
    "noteid":"noteIdNumber",
    "token":"yourToken"
}
*/

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require "../../memory.php";
require "../../app/tasks.php";
require "../../app/database/delete.php";
require "../../app/database/read.php";

$data = json_decode(file_get_contents("php://input")); //Gets data from request JSON.

if (isset($data->noteid)) {
    $noteid = $data->noteid;
    if (isset($data->token)) {
        $token = $data->token;
        if (token_given($token)) {
            $user_id = tokenValid_returnUserId($token);
            if ($user_id != null) {
                if (tokenHasDeletePermission($token)) {
                    delete_private_note_both_ids($noteid, $user_id);
                    echo json_encode(
                        array("status" => "success", "description" => "query executed"),
                        JSON_PRETTY_PRINT
                    );
                }
            }
        }
    } else {
        echo json_encode(
            array("status" => "failed", "description" => "token not given"),
            JSON_PRETTY_PRINT
        );
    }
} else {
    echo json_encode(
        array("status" => "failed", "description" => "note id not given"),
        JSON_PRETTY_PRINT
    );
}

// Checks if token content was given.
function token_given($token)
{
    if ($token != "") {
        return true;
    }
    echo json_encode(
        array("status" => "failed", "description" => "token not given"),
        JSON_PRETTY_PRINT
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
function tokenHasDeletePermission($token)
{
    $tokenPermissions = apiConnectionToken_bringPermissionDetails($token);
    if ($tokenPermissions["DeletePermission"] == 1) return true;
    else {
        echo json_encode(
            array("status" => "failed", "description" => "delete permission disallowed")
        );
        return null;
    }
}
