<?php

require "app/database/read.php";

$public_notes_result = fetch_public_notes_for_home_page();
$notes_array = array();

if ($public_notes_result->num_rows > 0) {
    for ($i = 0; $row = $public_notes_result->fetch_assoc(); $i++) {
        $notes_array[$i] = $row;
    }

    $array_length = count($notes_array);
    $note_title_string = "note_title_";
    $note_description_string = "note_description_";

    for ($j = 0; $j < count($notes_array); $j++) {

        $title;
        $description;
        $ID;

        $title = $notes_array[$array_length - 1]['title'];
        $description = $notes_array[$array_length - 1]['description'];
        $ID = $notes_array[$array_length - 1]['ID'];

        echo "<div class='note_container'>";
        echo "<div class='note_title' id='note_title_". $ID ."'>" . $title . "</div>";
        echo "<br>";
        echo "<div class='note_description' id='note_description_". $ID ."'>" . nl2br($description) . "</div>";
        echo "<div class='note_action_buttons_container'>";
        echo "<button type='button' class='note_action_button btn btn-secondary' onclick='copyTitleToClipboard(". $ID . ")'>Copy title</button>";
        echo "<button type='button' class='note_action_button btn btn-secondary' onclick='copyDescriptionToClipboard(" . $ID . ")'>Copy description</button>";
        echo "<button type='button' class='note_action_button btn btn-outline-danger' onclick='deletePublicNote(" . $ID . ")'>Delete this note</button>";
        echo "</div>";
        echo "</div>";
        echo "<br>";
        
        $array_length--;
    }
} else {
    echo "<div class='no_public_notes_stored'>";
    echo "No public notes stored.";
    echo "</div>";
}