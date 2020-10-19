<?php

require "../memory.php";
require "../app/tasks.php";
require "../app/database/delete.php";
require "../app/database/read.php";

// Interpreted code.
if (isset($_SESSION["userDeletionCode"]) && isset($_POST["input_userDeletionCode"])) {
    if ($_SESSION["userDeletionCode"] == $_POST["input_userDeletionCode"]) {
        delete_account();
    } else {
        return_to_private_notes();
    }
} else {
    return_to_private_notes();
}

function delete_account()
{
    $user_data = bring_user_data_by_cookie_sessionToken();
    delete_user($user_data["user_id"]);
    delete_associated_notes($user_data["user_id"]);
    delete_all_sessions_user_request_or_account_delete();
    delete_api_connection_token_UserId($user_data["user_id"]);
    delete_cookie_sessionToken();
    unset($_SESSION['userDeletionCode']);
    redirect_to_account_deleted_page();
}

function return_to_private_notes()
{
    $url = "./index.php";
    header('Location: ' . $url);
}

function return_to_public_notes()
{
    $url = "../index.php";
    header('Location: ' . $url);
}

function redirect_to_account_deleted_page()
{
    $url = "../response/account-deleted/";
    header('Location: ' . $url);
}
