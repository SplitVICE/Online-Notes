<?php


// Updates the user's password.
function update_user_password($new_password, $new_salt)
{
    $query_status = true;

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

    if ($stmt = $conn->prepare("UPDATE USER SET password = ?, salt = ? WHERE ID = ?")) {
        $stmt->bind_param("sss", $new_password, $new_salt, $_SESSION['user_id']);

        $stmt->execute();
        $stmt->close();
    } else {
        $query_status = false;
    }

    $conn->close();

    return $query_status;
}
