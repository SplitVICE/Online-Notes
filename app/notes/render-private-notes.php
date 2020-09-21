<?php

require "../memory.php";

$token_info = bring_sessionToken_info_by_sessionToken_value();

$public_notes_result = fetch_private_notes_for_private_page($token_info['user_id']);
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

        // Data get decrypted.
        $title = AES128_decrypt($notes_array[$array_length - 1]['title']);
        $description = AES128_decrypt($notes_array[$array_length - 1]['description']);
        $ID = $notes_array[$array_length - 1]['ID'];

        echo "<div class='note_container'>";
        echo "<div class='note_title' id='note_title_". $ID ."'>" . $title . "</div>";
        echo "<br>";
        echo "<div class='note_description' id='note_description_". $ID ."'>" . nl2br($description) . "</div>";
        echo "<div class='note_action_buttons_container'>";
        echo "<button type='button' class='note_action_button btn btn-outline-secondary btn-sm' onclick='copyDescriptionToClipboard(" . $ID . ")'>Copy description</button>";
        echo "<button type='button' class='note_action_button btn btn-outline-secondary btn-sm' onclick='copyTitleToClipboard(". $ID . ")'>Copy title</button>";
        echo "<button type='button' class='note_action_button btn btn-outline-danger btn-sm' onclick='deletePrivateNote(" . $ID . ")'>Delete this note</button>";
        echo "</div>";
        echo "</div>";
        echo "<br>";

        $array_length--;
    }
} else {
    echo "<div class='no_public_notes_stored'>";
    echo "No private notes stored.";
    echo "</div>";
}