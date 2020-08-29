<?php

$accounts_array = return_all_accounts_in_an_array();

if ($accounts_array) {
    echo '
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
        ';
    for ($i = 0; $i < count($accounts_array); $i++) {
        echo '
            <tr>
                <th scope="row">' . $accounts_array[$i]['ID'] . '</th>
                <td>' . $accounts_array[$i]['username'] . '</td>
                <td><a href="#/" onclick="deleteUser(' . $accounts_array[$i]['ID'] . ')">Delete this account</a></td>
            </tr>
        ';
    }
    echo '
            </tbody>
        </table>
    ';
} else {
    echo "No accounts registered.";
}
