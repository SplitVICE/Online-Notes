<?php

require "../memory.php";

$_SESSION['admin_logged_in'] = false;

$url = "../";
header('Location: ' . $url);
