function deletePublicNote(note_id) {
    Swal.fire({
        title: 'Are you sure you want to delete this note?',
        text: "The note will be deleted permanently.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.value) {
            location.href = "./app/notes/delete-public-note.php?note_id=" + note_id;
        }
    })
}

function copyTitleToClipboard(id) {
    note_title_id = "note_title_" + id
    const title = document.getElementById(note_title_id).innerText
    copy_text_to_clipboard(title);
    showModal_copied_into_clipboard("Title copied into clipboard");
}

function copyDescriptionToClipboard(id) {
    note_description_id = "note_description_" + id
    const desc = document.getElementById(note_description_id).innerText
    copy_text_to_clipboard(desc);
    showModal_copied_into_clipboard("Description copied into clipboard");
}

// Updates the counter of max characters the database can handle
// regarding how long the note description is.
function characters_counter() {
    const max_characters = 6500;
    const text_area_value =
        document.getElementById("note_description").value;
    const number_of_characters = text_area_value.length;

    const div_characters_left = document.getElementById('characters_left');
    div_characters_left.innerHTML =
        `Characters left: <span class="amount_of_characters">
                    ` + (max_characters - number_of_characters) + `
                </span>`
}
