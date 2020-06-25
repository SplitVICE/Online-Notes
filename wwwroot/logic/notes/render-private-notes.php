<?php

require "../logic/database/mysql.php";

$public_notes_result = fetch_private_notes_for_private_page($_SESSION['user_id']);
$notes_array = array();

if ($public_notes_result->num_rows > 0) {
    for ($i = 0; $row = $public_notes_result->fetch_assoc(); $i++) {
        $notes_array[$i] = $row;
    }

    $array_length = count($notes_array);

    for ($j = 0; $j < count($notes_array); $j++) {

        $title;
        $description;
        $ID;

        $title = $notes_array[$array_length - 1]['title'];
        $description = $notes_array[$array_length - 1]['description'];
        $ID = $notes_array[$array_length - 1]['ID'];

        echo "<div class='note_container'>";
        echo "<pre>";
        echo "<div class='note_title'>" . $title . "</div>";
        echo "<br>";
        echo "<div class='note_description'>" . $description . "</div>";
        echo "</pre>";
        echo "<div class='note_delete_button'><a href='#' onclick='deletePublicNote(" . $ID . ")'>Delete this note</a></div>";
        echo "</div>";
        echo "<br>";

        $array_length--;
    }
} else {
    echo "<div class='no_public_notes_stored'>";
    echo "No private notes stored.";
    echo "</div>";
}