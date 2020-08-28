<?php

require "../memory.php";

$password_input = $_POST["password-input"];

if ($password_input == $_ENV["onlinenotes_admin_password"]) {
    $_SESSION["admin_logged_in"] = true;
    echo "Password correct.";
    openAdminDashboard();
} else {
    echo "Password incorrect.";
    backToAdminLogin();
}

function backToAdminLogin()
{
    $url = "./authentication.php";
    header('Location: ' . $url);
}

function openAdminDashboard(){
    $url = "./index.php";
    header('Location: ' . $url);
}
