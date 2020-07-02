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

