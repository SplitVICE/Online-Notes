<?php

//Route: onlinenotes.vice/api/token/insert-private-note.php
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
$noteid = $data->noteid;
$token = $data->token;

if (    token_given($token)) {
    $user_id = tokenValid_returnId($token);
    if ($user_id != null) {
        delete_private_note_both_ids($noteid, $user_id);
        echo json_encode(
            array("status" => "success", "description" => "query executed")
        );
    }
}

function token_given($token)
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
function tokenValid_returnId($token)
{
    $return_obj = array("status" => "false", "ID" => "token not valid");
    $obj = api_connection_token_brind_id_if_exists($token);

    if ($obj == null) {
        echo json_encode(
            $return_obj
        );
        return null;
    }else{ 
        return $obj["user_id"];
    }
}
