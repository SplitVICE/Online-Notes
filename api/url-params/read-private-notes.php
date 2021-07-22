<?php

// Required variables: username, password, note-title, note-description.
// note-title variable is optional.
// onlinenotes.vice/api/url-params/read-private-notes.php?username=user&password=pass

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require "../../app/tasks.php";
require "../../memory.php";
require "../../app/database/create.php";
require "../../app/database/read.php";

$response = array();

if (!isset($_GET['username']) || !isset($_GET['password'])) {
    $response['status'] = "failed";
    $response['description'] = "no credentials given";
    echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
} else {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $result = check_credentials_return_id_api($username, $password);

    if ($result['ID'] != "NA" && $result['ID'] != "no record found") {
        $private_notes = fetch_private_notes_by_user_id_given($result["ID"]);
        echo json_encode($private_notes);
    } else {
        $response['status'] = "failed";
        $response['description'] = "credentials incorrect";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    }
}
