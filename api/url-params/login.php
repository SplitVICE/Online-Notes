<?php

/**
 * Logins an user by given parameters on the URL.
 * Automatically redirects to private notes if 
 * credentials are correct.
 * Usage example:
 * onlinenotes.com/api/url-params/login.php?username=yourUserName&password=yourPassword
 */

if (!isset($_GET['username']) || !isset($_GET['password']))
    badResponseMessage("failed", "credentials not given");
else {
    require "../../app/tasks.php";
    require "../../memory.php";
    require "../../app/database/read.php";
    require "../../app/database/create.php";
    $username = $_GET['username'];
    $password = $_GET['password'];

    $user_data = bring_user_data_by_username($username);

    if ($user_data['ID'] == "no record found") {
        $response['status'] = "failed";
        $response['description'] = "user not found";
        echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
    } else {
        $password_matches = sha512_compare($user_data['salt'], $password, $user_data['password']);
        if ($password_matches) {
            echo "Password correct";
            register_and_set_session_cookie($user_data);
            header("Location: ../../private-notes");
        } else
            badResponseMessage("failed", "password incorrect");
    }
}

function badResponseMessage($status, $description)
{
    $response['status'] = $status;
    $response['description'] = $description;
    echo $json_string = json_encode($response, JSON_PRETTY_PRINT);
}
