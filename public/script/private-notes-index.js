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

function openApiConnectionTokenPage() {
    location.href = "./api-connection-token";
}

// ====================================================================================================
// ====================================================================================================
// User deletion functions.

const userDeletionCode_notCorrect = document.getElementById("userDeletionCode_notCorrect");
const userDeletionCode_Correct = document.getElementById("userDeletionCode_Correct");

// Checks if the Deletion Code written down is correct.
// If not, an error notification is shown to the user.
function deletionCodeCheck() {
    const deleteAccount_textField = document.getElementById("deleteAccount_textField").value;
    const userDeletionCode = document.getElementById("userDeletionCode").textContent;

    if (deleteAccount_textField == userDeletionCode) {
        userDeletionCode_showCorrect();
    } else {
        userDeletionCode_showNotCorrect();
    }
}

// Shows not correct notification message.
function userDeletionCode_showNotCorrect() {
    userDeletionCode_notCorrect.style.display = "inline";
    userDeletionCode_Correct.style.display = "none";
}

// Shows correct notification message.
function userDeletionCode_showCorrect() {
    userDeletionCode_notCorrect.style.display = "none";
    userDeletionCode_Correct.style.display = "inline";
}

// Interpreted code.
userDeletionCode_notCorrect.style.display = "none";
userDeletionCode_Correct.style.display = "none";
