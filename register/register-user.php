<?php

if (empty($_POST['username_input']) || empty($_POST['password_input'])) {
    header("Location: ../../register/index.php?error=emptyFields");
} else {

    require "../app/tasks.php";
    require "../app/database/create.php";
    require "../app/database/read.php";

    $username = $_POST["username_input"];
    $password = $_POST["password_input"];
    $password_repeat = $_POST["password_input_repeat"];

    if ($password == $password_repeat) {
        $password_data = create_hashed_and_salted_password($password);

        $username_check = check_username_disponibility($username);

        if (!$username_check) {
            register_a_new_user(
                $username,
                $password_data['password_hashed'],
                $password_data['salt']
            );
        } else {
            header("Location: ../../register/index.php?error=usernameTaken");
        }
    } else {
        header("Location: ../../register/index.php?error=passwordsDoNotMatch");
    }
}
