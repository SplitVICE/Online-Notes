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
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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

    // Creates a new session statement at the database. Sets cookie to client.
    register_and_set_session_cookie($user_data);
}

// Creates a new session statement at the database. Sets cookie to client.
// Receives array with user info.
function register_and_set_session_cookie($user_data){
    $token = generateSessionToken();
    register_new_session_token($token, $user_data["ID"], $user_data["username"]);

    // Cookie is set to client's computer. Token is AES128 encrypted.
    setcookie("sessionToken", $token, time() + (10 * 365 * 24 * 60 * 60), "/");   
}

// Creates a session info. Info is AES128 encrypted.
function register_new_session_token($token, $user_id, $username){
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $user_id_encrypted = AES128_encrypt($user_id);
    $username_encrypted = AES128_encrypt($username);

    if ($stmt = $conn->prepare("INSERT INTO SESSION (user_id, user_username, token)
                                    VALUES(?,?,?)")) {
        $stmt->bind_param("sss"
        , $user_id_encrypted
        , $username_encrypted
        , $token);

        $stmt->execute();
        $stmt->close();
    }
    $conn->close();
}

// Function that inserts a new public note into the database.
// Required variables: too descriptive.
function insert_public_note($note_title, $note_description)
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

    // A prepared statement is made to perform the SQL query.
    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES('public', ?, ?, false, false)")) {
        $stmt->bind_param("ss", $note_title, $note_description);

        $stmt->execute();
        $stmt->close();
    }
    $conn->close();

    // When the query finishes, the user is redirected to project's root index.php.
    $url = "../../";
    header('Location: ' . $url);
}

// Function that inserts a new private note into the database.
// Required variables: too descriptive.
function insert_private_note($note_title, $note_description)
{
    // It is required to read user's ID to save the variable into
    // the database.
    // User's ID will determine who's the owner of this private note.
    $user_info = bring_user_data_by_cookie_sessionToken();
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // The note data get encrypted to be stored encrypted into the database.
    $note_title_encrypted = AES128_encrypt($note_title);
    $note_description_encrypted = AES128_encrypt($note_description);

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param("sss", $user_info["user_id"], $note_title_encrypted, $note_description_encrypted);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    // User is redirected to the route private-notes because that's where the user inserts
    // private notes.
    $url = "../../private-notes";
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

// Function that inserts a new public note into the database.
// This function is to store public notes with the use of the REST API.
// Go to route app/api/rest/insert-public-note/index.php to see this function being used.
// Required variables: too descriptive.
function insert_public_note_rest_api($note_title, $note_description)
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

    $query_status = true;

    $note_title_encrypted = AES128_encrypt($note_title);
    $note_description_encrypted = AES128_encrypt($note_description);

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param(
            "sss",
            $user_id,
            $note_title_encrypted,
            $note_description_encrypted
        );

        $stmt->execute();
        $stmt->close();
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}

// Function that inserts a new private note into the database.
// This function is to store private notes with the use of the REST API.
// Go to route app/api/rest/insert-private-note/index.php to see this function being used.
// Required variables: too descriptive [...] user_id variable is needed to store into
// the database who's the owner of this private note.
function insert_private_note_rest_api($note_title, $note_description, $user_id)
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

    $query_status = true;

    $note_title_encrypted = AES128_encrypt($note_title);
    $note_description_encrypted = AES128_encrypt($note_description);

    if ($stmt = $conn->prepare("INSERT INTO NOTE (owner_id, title, description, archived, in_trash_can)
                                    VALUES(?, ?, ?, false, false)")) {
        $stmt->bind_param(
            "sss",
            $user_id,
            $note_title_encrypted,
            $note_description_encrypted
        );

        $stmt->execute();
        $stmt->close();
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}

// Creates an API connection token when required.
function create_new_api_connection_token(){
    $user_data = bring_sessionToken_info_by_sessionToken_value(); // Returns user info from cookie.
    $apiConnectionToken = generate_apiConnectionToken();
    $user_id_encrypted = AES128_encrypt($user_data["user_id"]);

    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    
    $tinyInt_boolTrue = 1;
    $tinyInt_boolFalse = 0;
    if ($stmt = $conn->prepare
    ("INSERT INTO API_CONNECTION_TOKEN 
    (user_id
    , token
    , ReadPermission
    , PublishPermission
    , DeletePermission) 
    VALUES
    (?,?,?,?,?)")) {
        $stmt->bind_param("ssiii"
        , $user_id_encrypted
        , $apiConnectionToken
        , $tinyInt_boolTrue
        , $tinyInt_boolTrue
        , $tinyInt_boolFalse);

        $stmt->execute();
        $stmt->close();
    }
    $conn->close();
}
