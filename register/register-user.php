<?php
require "../memory.php";
require "../app/tasks.php";
require "../app/database/read.php";
require "../app/database/create.php";
require "../app/database/delete.php";
require "../app/database/update.php";

if (
    empty($_POST['username_input']) ||
    empty($_POST['password_input'])
) {
    header("Location: ../../register/index.php?error=emptyFields");
} else {
    $username = $_POST["username_input"];
    $password = $_POST["password_input"];
    $password_repeat = $_POST["password_input_repeat"];

    $username_check = check_username_disponibility($username);

    if (!$username_check) {
        if ($password == $password_repeat) {

            $password_data = create_hashed_and_salted_password($password);

            register_a_new_user(
                $username,
                $password_data['password_hashed'],
                $password_data['salt']
            );

            // User is redirected to route private-notes so that they can immediately use 
            // their new account.
            $url = "../private-notes";
            header('Location: ' . $url);
        } else {
            header("Location: ./index.php?error=passwordsDoNotMatch");
        }
    } else {
        header("Location: ./index.php?error=usernameTaken");
    }
}
