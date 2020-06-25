<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_logged_in'])) {
    $_SESSION['user_logged_in'] = false;
    $_SESSION['user_id'] = "n/a";
    $_SESSION['user_username'] = "n/a";
}