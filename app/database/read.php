<?php

// Fetches all the private notes stored into the database to be shown in the
// private notes page. Notes displayed are those associated with the user ID passed.
// This function returns a variable with all the rows found in the database.
// Go to route app/notes/render-private-notes.php to see this function being used.
function fetch_private_notes_for_private_page($username_id)
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

    $sql = "SELECT * FROM NOTE WHERE owner_id = '" . $username_id . "'";
    $private_notes_result = $conn->query($sql);
    $conn->close();
    return $private_notes_result;
}

// Checks if an username given when creating a new account has not been taken.
// Returns something if the user already exists, returns null or empty if
// username has not been taken.
function check_username_disponibility($username)
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

    $sql_query = "SELECT * FROM USER WHERE username = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->bind_result($username);

        $result = $stmt->fetch();

        $stmt->close();
    }

    $conn->close();

    return $result;
}

// Brings all the information of an user stored inside the database by an
// username given.
// This function returns a JSON object alike.
// JSON variable ID will be equals to "no record found" if redacted.
// This function is used to login. Usage can be find at:
// login/login-user.php .
function bring_user_data_by_username($username)
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

    $sql_query = "SELECT * FROM USER WHERE username = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->bind_result($ID, $username, $password, $salt);

        $array = array();
        if ($stmt->fetch()) {
            $array = array('ID' => $ID, 'username' => $username, 'password' => $password, 'salt' => $salt);
        } else {
            $array = array('ID' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        return $array;
    }
}

// Same function as bring_user_data_by_username but used to change
// user's password.
function bring_user_data_by_username_changePasswordCheck($username)
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

    $sql_query = "SELECT * FROM USER WHERE username = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $stmt->bind_result($ID, $username, $password, $salt);

        $array = array();
        if ($stmt->fetch()) {
            $array = array('ID' => $ID, 'username' => $username, 'password' => $password, 'salt' => $salt);
        } else {
            $array = array('ID' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        return $array;
    }
}

// This function returns the ID associated with an user account.
// Required variables: username and password.
// This function is only used when an user wants to create a new private
// note when using the API.
// This function is used at: app/api/insert-private-note/index.php .
function check_credentials_return_id($username_input, $password_input)
{
    require "../tasks.php";
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

        $stmt->close();

        $conn->close();

        return $json;
    }
}

// Fetches all the public notes stored into the database to be shown in the
// public notes page.
// This function returns a variable with all the rows found in the database.
// Go to route app/notes/render-public-notes.php to see this function being used.
function fetch_public_notes_for_home_page()
{
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql_query);
    $conn->close();
    return $public_notes_result;
}

// Returns all the notes stored into the database in an array.
// Returns null if there are not any notes stored.
// Private notes are decrypted.
function return_all_notes_in_an_array()
{
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // SQL query is made.
    $sql_query = "SELECT * FROM NOTE";
    $notes_sql_result = $conn->query($sql_query);

    // Logic if there are notes stored. If no notes stores
    // null is returned.
    if ($notes_sql_result->num_rows > 0) {

        require "../app/tasks.php";

        $notes_temporal_array = array();
        $notes_array_result = array();
        $test_results = false;

        for ($i = 0; $row = $notes_sql_result->fetch_assoc(); $i++) {
            $notes_temporal_array[$i] = $row;
            if ($test_results) {
                echo "Row content at index " . $i . "= " . $row['title'];
                echo "<br>";
                echo "notes_temporal_array content at index " . $i . "= " . $notes_temporal_array[$i]['title'];
                echo "<br>";
                echo "<br>";
            }
        }

        $conn->close();

        $notes_temporal_array_length = count($notes_temporal_array);
        $ID;
        $owner_id;
        $title;
        $description;
        $archived;
        $in_trash_can;

        for ($j = 0; $j < count($notes_temporal_array); $j++) {
            $ID = $notes_temporal_array[$notes_temporal_array_length - 1]['ID'];
            $owner_id = $notes_temporal_array[$notes_temporal_array_length - 1]['owner_id'];
            if ($owner_id != 'public') {
                $title = AES128_decrypt($notes_temporal_array[$notes_temporal_array_length - 1]['title']);
                $description = AES128_decrypt($notes_temporal_array[$notes_temporal_array_length - 1]['description']);
            } else {
                $title = $notes_temporal_array[$notes_temporal_array_length - 1]['title'];
                $description = $notes_temporal_array[$notes_temporal_array_length - 1]['description'];
            }
            $archived = $notes_temporal_array[$notes_temporal_array_length - 1]['archived'];
            $in_trash_can = $notes_temporal_array[$notes_temporal_array_length - 1]['in_trash_can'];

            $notes_array_result[$j]['ID'] = $ID;
            $notes_array_result[$j]['owner_id'] = $owner_id;
            $notes_array_result[$j]['title'] = $title;
            $notes_array_result[$j]['description'] = $description;
            $notes_array_result[$j]['archived'] = $archived;
            $notes_array_result[$j]['in_trash_can'] = $in_trash_can;

            if ($test_results) {
                echo "notes_array_result length: " . count($notes_array_result);
                echo "<br><br>";
            }
            $notes_temporal_array_length--;
        }

        if ($test_results) {
            echo "Entering notes_array_result";
            echo "<br>";
            for ($n = 0; $n < count($notes_array_result); $n++) {
                echo "notes_array_result index " . $n . " value: <br>";
                echo $notes_array_result[$n]['ID'];
                echo "<br>";
            }
        }

        return $notes_array_result;
    } else {
        return null;
    }
}


// Returns an array with all the accounts information stored.
// Returns null if there are not any account.
function return_all_accounts_in_an_array()
{
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // SQL query is made.
    $sql_query = "SELECT * FROM USER";
    $accounts_sql_result = $conn->query($sql_query);

    // Logic if there are notes stored. If no notes stores
    // null is returned.
    if ($accounts_sql_result->num_rows > 0) {

        $accounts_array = array();

        for ($i = 0; $row = $accounts_sql_result->fetch_assoc(); $i++) {
            $accounts_array[$i] = $row;
        }

        $conn->close();

        return $accounts_array;
    } else {
        return null;
    }
}