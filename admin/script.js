function adminLogout() {
  location.href = "./logout.php";
}

function deleteUser(id) {
  Swal.fire({
    title: `Delete account`,
    text: `You are about to delete an account and all its related notes. It won't be possible to revert. Are you sure?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete account.'
  }).then((result) => {
    if (result.value) {
      window.location.replace(`./delete-account.php?account_id=${id}`);
      Swal.fire(
        'Done',
        'The account has been deleted.',
        'success'
      )
    }
  })
}

function deleteAllPrivateNotes(id) {
  Swal.fire({
    title: `Delete private notes.`,
    text: `You are about to delete all the relates notes of the selected user. It won't be possible to revert. Are you sure?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete all private notes.'
  }).then((result) => {
    if (result.value) {
      window.location.replace(`./delete-all-private-notes-user.php?account_id=${id}`);
      Swal.fire(
        'Done',
        'The private notes of this user has been deleted.',
        'success'
      )
    }
  })
}

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
          location.href = "./delete-public-note.php?note_id=" + note_id;
      }
  })
}

function deletePrivateNote(note_id) {
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
          location.href = "./delete-private-note.php?note_id=" + note_id;
      }
  })
}

