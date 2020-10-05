<?php

$accounts_array = return_all_accounts_in_an_array();

if ($accounts_array) {
    echo '
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Private notes number</th>
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
                <td>' . $accounts_array[$i]['privateNotesAmount'] . '</td>
                <td>
                <a class="btn btn-danger btn-sm" href="#/" onclick="deleteUser(' . $accounts_array[$i]['ID'] . ')">Delete this account</a>
                <a class="btn btn-danger btn-sm" href="#/" onclick="deleteAllPrivateNotes(' . $accounts_array[$i]['ID'] . ')">Delete all private notes</a>
                </td>
            </tr>'
        ;
    }
    echo '
            </tbody>
        </table>
    ';
} else {
    echo "No accounts registered.";
}
