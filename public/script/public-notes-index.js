let noteLengthError_messageTooLarge_hasBeenShowed = false;

function deletePublicNote(note_id) {
    Swal.fire({
        title: 'Delete note?',
        text: "Note will be deleted permanently. Are you sure?",
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
    sweetAlert_success("Title copied into clipboard");
}

function copyDescriptionToClipboard(id) {
    note_description_id = "note_description_" + id
    const desc = document.getElementById(note_description_id).innerText
    copy_text_to_clipboard(desc);
    sweetAlert_success("Description copied into clipboard");
}

// Updates the counter of max characters the database can handle
// regarding how long the note description is.
function characters_counter() {
    const max_characters = 1980;
    const text_area_value =
        document.getElementById("note_description").value;
    const number_of_characters = text_area_value.length;
    let current_amount_of_characters = max_characters - number_of_characters;

    document.getElementById('characters_left').innerHTML =
        `Characters left: <span class="amount_of_characters">
                    ` + (current_amount_of_characters) + `
                </span>`

    if (current_amount_of_characters < 0) {
        if (!noteLengthError_messageTooLarge_hasBeenShowed) {
            Swal.fire({
                icon: 'error',
                title: 'Note too large!',
                text: `The note limit is ` + max_characters + ` characters. 
                    Please, reduce your note length. 
                    Notes with more than ` + max_characters + ` characters might cause an internal system error.`,
            })
            noteLengthError_messageTooLarge_hasBeenShowed = true;
        }
    }
}
