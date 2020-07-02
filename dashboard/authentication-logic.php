<?php

require "../memory.php";

$password_input = $_POST["password-input"];

if ($password_input == $_ENV["admin_password"]) {
    $_SESSION["admin_logged_in"] = true;
    echo "Password correct.";
    go_to_dashboard_index();
} else {
    echo "Password incorrect.";
    go_to_dashboard_index();
}

function go_to_dashboard_index()
{
    $url = "./index.php";
    header('Location: ' . $url);
}
