<?php

// Fetches all the private notes stored into the database to be shown in the
// private notes page. Notes displayed are those associated with the user ID passed.
// This function returns a variable with all the rows found in the database.
// Go to route app/notes/render-private-notes.php to see this function being used.
function fetch_private_notes_for_private_page($username_id)
{
    require '../../config.php';
    $conn = create_connection_and_return_conn_variable();

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
    require '../../../config.php';
    $conn = create_connection_and_return_conn_variable();

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
    require '../../../config.php';
    $conn = create_connection_and_return_conn_variable();

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

        $stmt->close();

        $conn->close();

        return $json;
    }
}

// This function returns the ID associated with an user account.
// Required variables: username and password.
// This function is only used when an user wants to create a new private
// note when using the API.
// This function is used at: app/api/insert-private-note/index.php .
function check_credentials_return_id($username_input, $password_input)
{
    require '../../../config.php';
    require "../../logic/tasks.php";

    $conn = create_connection_and_return_conn_variable();

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
    $conn = create_connection_and_return_conn_variable();

    $sql_query = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql_query);
    $conn->close();
    return $public_notes_result;
}
