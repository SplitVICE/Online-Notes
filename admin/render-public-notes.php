<?php
// Renders the table of private notes that can be seen at admin dashboard.

function render_public_notes($notes_array){
    echo '
        <table class="table table-sm table-bordered">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
        ';
    for ($i = 0; $i < count($notes_array); $i++) {
        if($notes_array[$i]["owner_id"] == "public"){
            echo '
                <tr>
                    <th scope="row">' . $notes_array[$i]['ID'] . '</th>
                    <td>' . $notes_array[$i]['title'] . '</td>
                    <td>' . $notes_array[$i]['description'] . '</td>
                    <td>
                    <a class="btn btn-danger btn-sm" href="#/" onclick="deletePublicNote(' . $notes_array[$i]['ID'] . ')">Delete this note</a>
                    </td>
                </tr>'
        ;
        }
    }
    echo '
            </tbody>
        </table>
    ';
}