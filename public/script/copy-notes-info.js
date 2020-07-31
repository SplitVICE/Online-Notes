function copyTitleToClipboard(id) {
    note_title_id = "note_title_" + id
    const title = document.getElementById(note_title_id).innerText
    copy_text_to_clipboard(title);
    sweetAlert_success("Title copied into clipboard");
}

function copyDescriptionToClipboard(id) {
    note_description_id = "note_description_" + id
    const desc = document.getElementById(note_description_id).innerText
    copy_text_to_clipboard(desc);
    sweetAlert_success("Description copied into clipboard");
}