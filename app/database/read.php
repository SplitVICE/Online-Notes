<?php

// Fetches all the private notes stored into the database to be shown in the
// private notes page. Notes displayed are those associated with the user ID passed.
// This function returns a variable with all the rows found in the database.
// Go to route app/notes/render-private-notes.php to see this function being used.
function fetch_private_notes_for_private_page($username_id)
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
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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
// Returns ID if exists. Returns NA if password incorrect. 
// Returns "no record found" if user not found. Returns key:value variable
// with key parameter called "ID".
function check_credentials_return_id_api($username_input, $password_input)
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

// This function returns the ID associated with an user account.
// Required variables: username and password.
// This function is only used when an user wants to create a new private
// note when using the REST API.
// This function is used at: app/api/insert-private-note/index.php .
// Returns ID if exists. Returns NA if password incorrect. 
// Returns "no record found" if user not found. Returns key:value variable
// with key parameter called "ID".
function check_credentials_return_id_json_api($username_input, $password_input)
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
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql_query);
    $conn->close();
    return $public_notes_result;
}

// Fetches all the public stored on the database and returns them as a JSON.
function fetch_public_notes_for_api()
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

    $sql_query = "SELECT * FROM NOTE WHERE owner_id = 'public'";
    $public_notes_result = $conn->query($sql_query);
    $conn->close();

    $notes_array = array();

    if ($public_notes_result->num_rows > 0) {
        for ($i = 0; $row = $public_notes_result->fetch_assoc(); $i++) {
            $notes_array[$i] = $row;
        }
    }

    return $notes_array;
}

// Returns all the notes stored into the database in an array.
// Returns null if there are not any notes stored.
// Private notes are decrypted.
function return_all_notes_in_an_array()
{
    // Reverse array explanation: when query to all notes is done, this
    // array will come with the latest note as the last one. So, the code
    // will reverse the array to show the latest note stored as the first one
    // on top of the array.

    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
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

        // Inverted array. 
        $notes_temporal_array = array();
        // Will contain the array at the right side and the private notes decrypted.
        // Will be the value returned if notes are stored.
        $notes_array_result = array();

        // Filling $notes_temporal_array with the MySQL query.
        for ($i = 0; $row = $notes_sql_result->fetch_assoc(); $i++) {
            $notes_temporal_array[$i] = $row;
        }
        $conn->close();

        // This counter will be used to reverse the array to the right side.
        $notes_temporal_array_length = count($notes_temporal_array);

        // Temporal variables for private notes.
        $ID;
        $owner_id;
        $title;
        $description;
        $archived;
        $in_trash_can;

        // For loop that reverses the array using $notes_temporal_array_length -1.
        // Also decrypts the private notes.
        for ($j = 0; $j < count($notes_temporal_array); $j++) {
            $ID = $notes_temporal_array[$notes_temporal_array_length - 1]['ID'];
            $owner_id = $notes_temporal_array[$notes_temporal_array_length - 1]['owner_id'];

            // If private note, the note gets decrypted.
            if ($owner_id != 'public') {
                $title = AES128_decrypt($notes_temporal_array[$notes_temporal_array_length - 1]['title']);
                $description = AES128_decrypt($notes_temporal_array[$notes_temporal_array_length - 1]['description']);
            } else { // If public note, the value remains the same.
                $title = $notes_temporal_array[$notes_temporal_array_length - 1]['title'];
                $description = $notes_temporal_array[$notes_temporal_array_length - 1]['description'];
            }

            // These last variables are not encrypted.
            $archived = $notes_temporal_array[$notes_temporal_array_length - 1]['archived'];
            $in_trash_can = $notes_temporal_array[$notes_temporal_array_length - 1]['in_trash_can'];

            // New registry on $notes_array_result array is made.
            $notes_array_result[$j]['ID'] = $ID;
            $notes_array_result[$j]['owner_id'] = $owner_id;
            $notes_array_result[$j]['title'] = $title;
            $notes_array_result[$j]['description'] = $description;
            $notes_array_result[$j]['archived'] = $archived;
            $notes_array_result[$j]['in_trash_can'] = $in_trash_can;

            // Length of the original inverted array counter is diminished.
            $notes_temporal_array_length--;
        }
        // Returns public notes, private notes decrypted, and notes at the right side.
        return $notes_array_result;
    } else {
        // If no public or private notes stored, null is returned.
        return null;
    }
}

// Returns an array with all the accounts information stored.
// Returns null if there are not any account.
function return_all_accounts_in_an_array()
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

    // SQL query is made.
    $sql_query = "SELECT * FROM USER";
    $accounts_sql_result = $conn->query($sql_query);

    // Logic if there are notes stored. If no notes stores
    // null is returned.
    if ($accounts_sql_result->num_rows > 0) {

        $accounts_array = array();

        for ($i = 0; $row = $accounts_sql_result->fetch_assoc(); $i++) {
            $accounts_array[$i] = $row;
            $accounts_array[$i]["privateNotesAmount"] =
                returnAmountOfPrivateNotesAssociatedWithUser($row["ID"]);
        }

        $conn->close();

        return $accounts_array;
    } else {
        return null;
    }
}

// Returns int number with the number of private notes an user has created.
// Required parameter: User's id. In other words, returns the number of private
// notes an user is owner of.
// If any note found, returns 0.
function returnAmountOfPrivateNotesAssociatedWithUser($user_id)
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

    $sql = "SELECT * FROM NOTE WHERE owner_id = '" . $user_id . "'";
    $private_notes_result = $conn->query($sql);
    $conn->close();
    return $private_notes_result->num_rows; // Returns the number of parameters in array.
}

// Returns user's username by passing an ID.
function bring_username_by_its_id($userId)
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

    $sql_query = "SELECT * FROM USER WHERE ID = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("i", $userId);

        $stmt->execute();

        $stmt->bind_result($ID, $username, $password, $salt);

        $array = array();
        if ($stmt->fetch()) {
            $array = array('username' => $username);
        } else {
            $array = array('ID' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        if (isset($array)) {
            foreach ($array as $value) {
                return $value;
            }
        } else {
            return "Error 500.";
        }
    }
}

// bring_sessionToken_info_by_sessionToken_value function helper.
// Returns SESSION information by COOKIE token value.
// Returns null if session token does not exist in the database.
function bring_user_data_by_cookie_sessionToken()
{
    if (isset($_COOKIE["sessionToken"])) {
        $sessionToken_array = bring_sessionToken_info_by_sessionToken_value();
        if (isset($sessionToken_array)) {
            if ($sessionToken_array["ID"] == "no record found") {
                return null;
            }
            return $sessionToken_array;
        }
    }
    return null;
}

// Brings SESSION information by COOKIE set on client browser.
// Returns array with ID, user_id, user_username, and token.
// Returns array with ID => no record found if user not found.
function bring_sessionToken_info_by_sessionToken_value()
{
    $sessionToken_value = $_COOKIE["sessionToken"];

    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM SESSION WHERE token = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $sessionToken_value);

        $stmt->execute();

        $stmt->bind_result($ID, $user_id, $user_username, $token);

        $array = array();
        if ($stmt->fetch()) {
            $array = array(
                'ID' => $ID, 'user_id' => AES128_decrypt($user_id), 'user_username' => AES128_decrypt($user_username), 'token' => $token
            );
        } else {
            $array = array('ID' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        return $array;
    }
}

// Brings the token number to the user on the cookie info stored at client browser.
// Returns null if record not found.
function bring_api_connection_token_by_user_cookie_info()
{
    $user_data = bring_sessionToken_info_by_sessionToken_value();
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

    $sql_query = "SELECT * FROM API_CONNECTION_TOKEN WHERE user_id = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $user_id_encrypted);

        $stmt->execute();

        $stmt->bind_result($ID, $user_id, $token, $ReadPermission, $PublishPermission, $DeletePermission);

        $array = array();
        if ($stmt->fetch()) {
            $array = array(
                'ID' => $ID
                , 'user_id' => AES128_decrypt($user_id)
                , 'token' => $token
                , "ReadPermission" => $ReadPermission
                , "PublishPermission" => $PublishPermission
                , "DeletePermission" => $DeletePermission
            );
        } else {
            $array = array('ID' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        return $array;
    }
}

// Returns an array of private notes by given the user ID.
// Returns all private notes info decrypted.
function fetch_private_notes_by_user_id_given($user_id)
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

    $sql = "SELECT * FROM NOTE WHERE owner_id = '" . $user_id . "'";
    $private_notes_result = $conn->query($sql);

    $notes_array = array();

    if ($private_notes_result->num_rows > 0) {
        for ($i = 0; $row = $private_notes_result->fetch_assoc(); $i++) {
            $notes_array[$i] = $row;
        }

        // Decrypts the notes.
        for($i = 0; $i < count($notes_array); ++$i) {
            $notes_array[$i]["title"] = AES128_decrypt($notes_array[$i]["title"]);
            $notes_array[$i]["description"] = AES128_decrypt($notes_array[$i]["description"]);
        }

    }else{
        $notes_array = array("status" => "warning", "description" => "user does not have private notes");
    }

    $conn->close();
    return $notes_array;
}

// Checks into the database if the token given exists.
// If so, returns the user ID whose belongs this token.
// If token does not exists, returns null.
// Note: function has name mistake: brind -> bring*.
function api_connection_token_brind_id_if_exists($token){
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM API_CONNECTION_TOKEN WHERE token = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $token);

        $stmt->execute();

        $stmt->bind_result($ID, $user_id, $token, $ReadPermission, $PublishPermission, $DeletePermission);

        $array = array();
        if ($stmt->fetch()) {
            $array = array(
                'ID' => $ID, 'user_id' => AES128_decrypt($user_id), 'token' => $token
            );
        } else {
            $array = array('ID' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        if($array['ID'] == 'no record found'){
            return null;
        }else{
            return $array;
        }
    }
}

// Returns array with read, delete, and publish permissions.
// Used to check if the token's permissions.
// Requires token's itself code.
function apiConnectionToken_bringPermissionDetails($token){
    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM API_CONNECTION_TOKEN WHERE token = ?";

    if ($stmt = $conn->prepare($sql_query)) {

        $stmt->bind_param("s", $token);

        $stmt->execute();

        $stmt->bind_result($ID, $user_id, $token, $ReadPermission, $PublishPermission, $DeletePermission);

        $array = array();
        if ($stmt->fetch()) {
            $array = array(
                "ReadPermission" => $ReadPermission
                , "PublishPermission" => $PublishPermission
                , "DeletePermission" => $DeletePermission
            );
        } else {
            $array = array('status' => 'no record found');
        }

        $stmt->close();

        $conn->close();

        return $array;
    }
}
