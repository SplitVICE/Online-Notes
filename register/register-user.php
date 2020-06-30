<?php

if (empty($_POST['username_input']) || empty($_POST['password_input'])) {
    header("Location: ../../register/index.php?error=emptyFields");
} else {

    require "../tasks.php";
    require "../database/mysql.php";

    $username = $_POST["username_input"];
    $password = $_POST["password_input"];
    $password_repeat = $_POST["password_input_repeat"];

    if ($password == $password_repeat) {
        $salt = generateRandomString(100);
        $password_ingredients = $salt . $password;
        $password_hashed = sha512_hashing($password_ingredients);

        $username = check_username_disponibility($username);

        if (!$is_username_not_taken) {
            register_a_new_user($username, $password_hashed, $salt);
        } else {
            header("Location: ../../register/index.php?error=usernameTaken");
        }
    }else{
        header("Location: ../../register/index.php?error=passwordsDoNotMatch");
    }
}
