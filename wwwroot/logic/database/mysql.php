<?php

function simple_query($query_string)
{
    require '../../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($conn->query($query_string) === true) {
        /* If success, redirect to route. If not, error is shown.*/
        $url = "/";
        header('Location: ' . $url);
    } else {
        echo "Error: " . $query_string . "<br>" . $conn->error;
    }
}

function insert_public_note($note_title, $note_description)
{
    require '../../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES('public', ?, ?, false, false)")) {
        $stmt->bind_param("ss", $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    $url = "/";
    header('Location: ' . $url);
}

function delete_public_note($note_id)
{
    require '../../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE ID = ?;")) {
        $stmt->bind_param("i", $note_id);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    $url = "/";
    header('Location: ' . $url);
}

function fetch_public_notes_for_home_page()
{
    require '../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql);
    $conn->close();
    return $public_notes_result;
}

function fetch_private_notes_for_private_page($username_id)
{
    require '../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM NOTE WHERE owner_id = '" . $username_id . "'";
    $private_notes_result = $conn->query($sql);
    $conn->close();
    return $private_notes_result;
}

function insert_private_note($note_title, $note_description)
{
    require '../../../config.php';
    require '../../../memory.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param("sss", $_SESSION["user_id"], $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    $url = "/private";
    header('Location: ' . $url);
}

function register_a_new_user($username, $password, $salt)
{
    require '../../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("INSERT INTO USER (username, password, salt)
                                    VALUES(?,?,?)")) {
        $stmt->bind_param("sss", $username, $password, $salt);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    $url = "/";
    header('Location: ' . $url);
}

function check_username_disponibility($username)
{
    require '../../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM USER WHERE username = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->bind_result($results);

        $result = $stmt->fetch();

        $stmt->close();

        return $result;
    }
}

function check_if_username_exists($username)
{
    require '../../../config.php';
    $conn = new mysqli(
        $database_server_name,
        $database_username,
        $database_password,
        $database_name
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM USER WHERE username = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->bind_result($ID, $username, $password, $salt);

        $json = array();
        if ($stmt->fetch()) {
            $json = array('ID' => $ID, 'username' => $username, 'password' => $password, 'salt' => $salt);
        } else {
            $json = array('ID' => 'no record found');
        }

        $conn->close();

        $stmt->close();

        return $json;
    }
}
