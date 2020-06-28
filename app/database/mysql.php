<?php

function create_connection_and_return_conn_variable()
{   
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
        return null;
    }else{
        return $conn;
    }
}

function insert_public_note($note_title, $note_description)
{
    $conn = create_connection_and_return_conn_variable();

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

function fetch_public_notes_for_home_page()
{
    $conn = create_connection_and_return_conn_variable();

    $sql = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql);
    $conn->close();
    return $public_notes_result;
}

function insert_public_note_api($note_title, $note_description)
{
    $query_status = false;

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
        $query_status = true;
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}

function insert_private_note_api($note_title, $note_description, $user_id)
{
    $query_status = false;

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
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param("sss", $user_id, $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
        $query_status = true;
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
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

    if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE ID = ? AND owner_id = 'public';")) {
        $stmt->bind_param("i", $note_id);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
    $url = "/";
    header('Location: ' . $url);
}

function delete_private_note($note_id)
{
    require '../../../config.php';
    require '../../../memory.php';

    if (isset($_SESSION['user_logged_in'])) {
        $conn = new mysqli(
            $database_server_name,
            $database_username,
            $database_password,
            $database_name
        );

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE ID = ? AND owner_id = ?;")) {
            $stmt->bind_param("is", $note_id, $_SESSION['user_id']);

            $stmt->execute();
            $stmt->close();
        }

        $conn->close();
        $url = "/private";
        header('Location: ' . $url);
    } else {
        $url = "/";
        header('Location: ' . $url);
    }
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

    if ($stmt = $conn->prepare("INSERT INTO USER (username, password, salt)
                                    VALUES(?,?,?)")) {
        $stmt->bind_param("sss", $username, $password, $salt);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    $user_data = bring_user_data_by_username($username);

    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_id'] = $user_data['ID'];
    $_SESSION['user_username'] = $username;

    $url = "/private";
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

function bring_user_data_by_username($username)
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

function check_credentials_return_id($username_input, $password_input)
{
    require '../../../config.php';
    require "../../logic/tasks.php";

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

        $stmt->bind_param("s", $username_input);

        $stmt->execute();

        $stmt->bind_result($ID, $username, $password, $salt);

        $json = array();
        if ($stmt->fetch()) {

            $json = array();

            $is_password_correct = sha512_compare($salt, $password_input, $password);

            if ($is_password_correct) {
                $json['ID'] = $ID;
            } else {
                $json['ID'] = "NA";
            }
        } else {
            $json = array('ID' => 'no record found');
        }

        $conn->close();

        $stmt->close();

        return $json;
    }
}

function delete_user($user_id)
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

    if ($stmt = $conn->prepare("DELETE FROM USER WHERE ID = ?")) {
        $stmt->bind_param("s", $user_id);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

function delete_associated_notes($user_id)
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

    if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE owner_id = ?")) {
        $stmt->bind_param("s", $user_id);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

function update_user_password($new_password, $new_salt)
{
    $query_status = false;

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

    if ($stmt = $conn->prepare("UPDATE USER SET password = ?, salt = ? WHERE ID = ?")) {
        $stmt->bind_param("sss", $new_password, $new_salt, $_SESSION['user_id']);

        $stmt->execute();
        $stmt->close();
        $query_status = true;
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}

function bring_admins_info()
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

    $sql = "SELECT * FROM ADMIN";
    $public_notes_result = $conn->query($sql);
    $conn->close();
    return $public_notes_result;
}

function register_initial_admin($username_input, $password_input, $salt)
{
    $query_status = false;

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

    if ($stmt = $conn->prepare("INSERT INTO ADMIN (username, password, salt)
                                    VALUES(?, ?, ?)")) {
        $stmt->bind_param("sss", $username_input, $password_input, $salt);

        $stmt->execute();
        $stmt->close();
        $query_status = true;
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}

function fetch_notes_for_api()
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

    $sql = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql);
    $conn->close();
    return $public_notes_result;
}
