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
            location.href = "../logic/get/delete-public-note.php?note_id=" + note_id;
        }
    })
}
