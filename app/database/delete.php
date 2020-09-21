<?php

// CRUD -> Delete php file.

// Function that deletes a public note by the note's ID.
function delete_public_note($note_id)
{
    require "../../memory.php";
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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

    // User is redirected to project root route.
    $url = "../../";
    header('Location: ' . $url);
}

// Function that deletes a private note.
function delete_private_note($note_id)
{
    // If user is not logged in, they will be automatically redirected to project root route.
    if (isset($_COOKIE['sessionToken'])) {

        // Brings token data stored.
        $user_data = bring_sessionToken_info_by_sessionToken_value();

        $conn = new mysqli(
            $_ENV['onlinenotes_database_server_name'],
            $_ENV['onlinenotes_database_username'],
            $_ENV['onlinenotes_database_password'],
            $_ENV['onlinenotes_database_name']
        );

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        // The note is deleted by their associated owner's ID. This ID is stored inside 
        // SESSION variables. This prevents malicious actions on deleting private notes.
        if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE ID = ? AND owner_id = ?;")) {
            $stmt->bind_param("is", $note_id, $user_data['user_id']);

            $stmt->execute();
            $stmt->close();
        }

        $conn->close();
        $url = "../../private-notes";
        header('Location: ' . $url);
    } else {
        $url = "../../";
        header('Location: ' . $url);
    }
}

// Function that deletes an user account stored into the database.
function delete_user($user_id)
{
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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

// Function that deletes ALL the notes associated with the passed
// user ID in this function.
// This function is called after an user's account was deleted.
// All the notes associated with this account are also deleted due it's lack
// ownership.
function delete_associated_notes($user_id)
{
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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

// Deletes a note in admin mode. Admins can delete any note.
function delete_note_admin($note_id)
{
    require "../memory.php";
    if ($_SESSION['admin_logged_in']) {
        $conn = new mysqli(
            $_ENV['onlinenotes_database_server_name'],
            $_ENV['onlinenotes_database_username'],
            $_ENV['onlinenotes_database_password'],
            $_ENV['onlinenotes_database_name']
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
    }
}

// Deletes all the public notes stored in the database.
function delete_all_public_notes(){
    require "../memory.php";
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $value = "public";

    if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE owner_id = ?;")) {
        $stmt->bind_param("s", $value);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

// Function that deletes a public note by the note's ID.
// Does the same as function delete_public_note but this
// will redirect to admin route.
function delete_public_note_admin($note_id)
{
    require "../memory.php";
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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

    // User is redirected to project root route.
    $url = "../admin/index.php";
    header('Location: ' . $url);
}

// Deletes all sessions by user request.
function delete_all_sessions_user_request_or_account_delete(){
    // Brings data stored at session.
    $user_data = bring_user_data_by_cookie_sessionToken();

    // Encrypts the data so can be referenced at session table.
    $user_data_userId_encrypted = AES128_encrypt($user_data["user_id"]);
    $user_data_userUsername_encrypted = AES128_encrypt($user_data["user_username"]);

    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("DELETE FROM SESSION WHERE user_id = ? AND user_username = ?")) {
        $stmt->bind_param("ss"
        , $user_data_userId_encrypted
        , $user_data_userUsername_encrypted);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}

function delete_session_register_by_user_logout(){
    $token = $_COOKIE["sessionToken"];

    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("DELETE FROM SESSION WHERE token = ?")) {
        $stmt->bind_param("s"
        , $token);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}
