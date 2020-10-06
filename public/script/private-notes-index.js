function deletePrivateNote(note_id) {
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
            location.href = "../app/notes/delete-private-note.php?note_id=" + note_id;
        }
    })
}

function deleteUserAccount() {
    const dltAcc_value = document.getElementById("deleteAccount_textField").value;
    const dltAcc_value_lowercase = dltAcc_value.toLowerCase();
    if (dltAcc_value_lowercase == "delete") {
        location.href = "./delete-user.php";
    }else{
        alert("Not correct account deletion phrase.");
    }
}

function openApiConnectionTokenPage(){
    location.href = "./api-connection-token";
}
