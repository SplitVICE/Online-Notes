<?php


// Function to update the user's password.
function update_user_password($new_password, $new_salt)
{
    $query_status = true;

    require '../../../config.php';
    require '../../../memory.php';
    $conn = create_connection_and_return_conn_variable();

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
