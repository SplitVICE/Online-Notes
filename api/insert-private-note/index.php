<?php

// Required variables: username, password, note-title, note-description.
// note-title variable is optional.

$response = array();

if (!isset($_GET['username']) || !isset($_GET['password'])) {
    $response['status'] = "failed";
    $response['description'] = "no credentials given";
    echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
} else {
    $username = $_GET['username'];
    $password = $_GET['password'];

    require "../../logic/database/mysql.php";

    $result = check_credentials_return_id($username, $password);

    if ($result['ID'] != "NA") {
        if (isset($_GET['note-description'])) {

            $note_title = "";
            $note_description = $_GET['note-description'];

            if (!isset($_GET['note-title'])) {
                $note_title = "Untitled note";
            } else {
                if ($_GET['note-title'] != "") {
                    $note_title = $_GET['note-title'];
                } else {
                    $note_title = "Untitled note";
                }
            }

            if (insert_private_note_api($note_title, $note_description, $result['ID'])) {
                $response['status'] = "success";
                $response['description'] = "private note has been saved";
                echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
            } else {
                $response['status'] = "failed";
                $response['description'] = "internal database error";
                echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
            }
        } else {
            $response['status'] = "failed";
            $response['description'] = "note description not given";
            echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
        }
    } else {
        $response['status'] = "failed";
        $response['description'] = "bad credentials";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    }
}
