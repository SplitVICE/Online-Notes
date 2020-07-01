<?php

// CRUD -> Create php file.

// This function registers a new user into the database.
// Required variables:
// username: user's username.
// password: this password is hashed and salted with SHA512.
// salt: the salt used to salt the password.
// The process to build the hashed password can be found at app/tasks.php
function register_a_new_user($username, $password, $salt)
{
    require "../memory.php";
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
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

    // Once the username is registered, the user is data is brought back just to
    // store it's ID given by the database into SESSION variables.
    $user_data = bring_user_data_by_username($username);

    // User is established as "logged in" automatically when they create an account.
    // User's username and database ID are also stored in SESSION variables.
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_id'] = $user_data['ID'];
    $_SESSION['user_username'] = $username;

    // User is redirected to route private-notes so that they can immediately use 
    // their new account.
    $url = "/private-notes";
    header('Location: ' . $url);
}

// Function that inserts a new public note into the database.
// Required variables: too descriptive.
function insert_public_note($note_title, $note_description)
{
    require "../../memory.php";
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // A prepared statement is made to perform the SQL query.
    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES('public', ?, ?, false, false)")) {
        $stmt->bind_param("ss", $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
    }
    $conn->close();

    // When the query finishes, the user is redirected to project's root index.php.
    $url = "/";
    header('Location: ' . $url);
}

// Function that inserts a new private note into the database.
// Required variables: too descriptive.
function insert_private_note($note_title, $note_description)
{
    // It is required to read user's ID to save the variable into
    // the database.
    // User's ID will determine who's the owner of this private note.
    require "../../memory.php";
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    require "../tasks.php";

    // The note data get encrypted to be stored encrypted into the database.
    $note_title_encrypted = AES128_encrypt($note_title);
    $note_description_encrypted = AES128_encrypt($note_description);

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param("sss", $_SESSION["user_id"], $note_title_encrypted, $note_description_encrypted);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    // User is redirected to the route private-notes because that's where the user inserts
    // private notes.
    $url = "/private-notes";
    header('Location: ' . $url);
}

////////////////////////////////////////////////////////////
// API functions.
////////////////////////////////////////////////////////////

// Function that inserts a new public note into the database.
// This function is to store public notes with the use of the API.
// Go to route app/api/insert-public-note/index.php to see this function being used.
// Required variables: too descriptive.
function insert_public_note_api($note_title, $note_description)
{
    $conn = create_connection_and_return_conn_variable();

    // This variable controls if the public note was successfully stored into the database.
    // This variable is returned as true if the query was successful.
    // Returns false if there was some kind of error in the process.
    $query_status = true;

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES('public', ?, ?, false, false)")) {
        $stmt->bind_param("ss", $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
    } else {
        // Variable will be false if there is an error.
        $query_status = false;
    }
    $conn->close();
    return $query_status;
}

// Function that inserts a new private note into the database.
// This function is to store private notes with the use of the API.
// Go to route app/api/insert-private-note/index.php to see this function being used.
// Required variables: too descriptive [...] user_id variable is needed to store into
// the database who's the owner of this private note.
function insert_private_note_api($note_title, $note_description, $user_id)
{
    $query_status = true;

    $conn = create_connection_and_return_conn_variable();

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param("sss", $user_id, $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}
