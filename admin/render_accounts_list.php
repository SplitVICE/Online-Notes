<?php

$accounts_array = return_all_accounts_in_an_array();

if ($accounts_array) {
    for ($i = 0; $i < count($accounts_array); $i++) {
        echo "ID: " . $accounts_array[$i]['ID'];
        echo "<br>";
        echo "Username: " . $accounts_array[$i]['username'];
        echo "<br>";
        echo "<a href='delete-account.php?account=" . $accounts_array[$i]['ID'] . "'>Delete this account</a>";
        echo "<br>";
        echo "<br>";
    }
} else {
    echo "No accounts registered.";
}
