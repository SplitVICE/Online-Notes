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
