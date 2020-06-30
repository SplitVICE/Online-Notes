<?php

// CRUD -> Delete php file.

// Function that deletes a public note by the note's ID.
function delete_public_note($note_id)
{
    $conn = create_connection_and_return_conn_variable();

    if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE ID = ? AND owner_id = 'public';")) {
        $stmt->bind_param("i", $note_id);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();

    // User is redirected to project root route.
    $url = "/";
    header('Location: ' . $url);
}

// Function that deletes a private note.
function delete_private_note($note_id)
{
    require '../../../config.php';
    require '../../../memory.php';

    // If user is not logged in, they will be automatically redirected to project root route.
    if (isset($_SESSION['user_logged_in'])) {
        $conn = create_connection_and_return_conn_variable();

        // The note is deleted by their associated owner's ID. This ID is stored inside 
        // SESSION variables. This prevents further errors inside the database.
        if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE ID = ? AND owner_id = ?;")) {
            $stmt->bind_param("is", $note_id, $_SESSION['user_id']);

            $stmt->execute();
            $stmt->close();
        }

        $conn->close();
        $url = "/private-notes";
        header('Location: ' . $url);
    } else {
        $url = "/";
        header('Location: ' . $url);
    }
}

// Function that deletes an user account stored into the database.
function delete_user($user_id)
{
    require '../../config.php';
    $conn = create_connection_and_return_conn_variable();

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
    require '../../config.php';
    $conn = create_connection_and_return_conn_variable();

    if ($stmt = $conn->prepare("DELETE FROM NOTE WHERE owner_id = ?")) {
        $stmt->bind_param("s", $user_id);

        $stmt->execute();
        $stmt->close();
    }

    $conn->close();
}
