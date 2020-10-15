<?php

// Updates the user's password.
function update_user_password($new_password, $new_salt)
{
    $query_status = true;

    require "../../memory.php";

    $user_data = bring_user_data_by_cookie_sessionToken();

    $conn = new mysqli(
        $_ENV['onlinenotes_database_server_name'],
        $_ENV['onlinenotes_database_username'],
        $_ENV['onlinenotes_database_password'],
        $_ENV['onlinenotes_database_name']
    );

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($stmt = $conn->prepare("UPDATE USER SET password = ?, salt = ? WHERE ID = ?")) {
        $stmt->bind_param("sss", $new_password, $new_salt, $user_data["user_id"]);

        $stmt->execute();
        $stmt->close();
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}

// Updates API Connection Token's publish, read, and delete permissions.
function update_apiConnectionToken_permissions($publish, $read, $delete)
{
    $user_data = bring_sessionToken_info_by_sessionToken_value(); // Returns user info from cookie.
    $apiConnectionToken_data = bring_api_connection_token_by_user_cookie_info();
    if ($user_data["user_id"] == $apiConnectionToken_data["user_id"]) {
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

        if ($stmt = $conn->prepare("UPDATE API_CONNECTION_TOKEN 
        SET PublishPermission = ?, ReadPermission = ?,  DeletePermission = ? WHERE user_id = ?")) {
            $stmt->bind_param(
                "iiis",
                $publish,
                $read,
                $delete,
                $user_id_encrypted
            );

            $stmt->execute();
            $stmt->close();
        }
        $conn->close();

    }else{
        echo "No Match";
    }
}
