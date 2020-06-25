<?php

require "../tasks.php";
require "../database/mysql.php";

$username = $_POST["username_input"];
$password = $_POST["password_input"];

$salt = generateRandomString(100);
$password_ingredients = $salt . $password;
$password_hashed = sha512_hashing($password_ingredients);

$is_username_not_taken = check_username_disponibility($username);

//register_a_new_user($username, $password_hashed, $salt);