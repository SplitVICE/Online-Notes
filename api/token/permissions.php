<?php
// =================================================================
// === Usage. ===
// Returns JSON with API Connection Token's current permissions.

//Route: onlinenotes.vice/api/token/permissions.php
//JSON template:
/*
{
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

$data = json_decode(file_get_contents("php://input")); //Gets data from request JSON.

if (isset($data->token)) {
    $token = $data->token;
    if (token_given($token)) {
        $status = isTokenValid($token);
        if ($status != null) {
            $permissions = apiConnectionToken_bringPermissionDetails($token);
            echo json_encode(
                array(
                    "status" => "success"
                    , "description" => "token valid"
                    , "ReadPermission" => $permissions["ReadPermission"]
                    , "PublishPermission" => $permissions["PublishPermission"]
                    , "DeletePermission" => $permissions["DeletePermission"]
                )
            );
        }
    }
} else {
    echo json_encode(
        array("status" => "failed", "description" => "token not given")
    );
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
function isTokenValid($token)
{
    $return_obj = array("status" => "failed", "description" => "token not valid");
    $obj = api_connection_token_brind_id_if_exists($token);

    if ($obj == null) {
        echo json_encode(
            $return_obj
        );
        return null;
    } else {
        return true;
    }
}
