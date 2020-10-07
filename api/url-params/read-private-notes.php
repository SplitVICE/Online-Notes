<?php

// Required variables: username, password, note-title, note-description.
// note-title variable is optional.

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

    if ($result['ID'] != "NA") {
        $private_notes = fetch_private_notes_by_user_id_given($result["ID"]);
        echo json_encode($private_notes);
    } else {
        $response['status'] = "failed";
        $response['description'] = "bad credentials";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    }
}
