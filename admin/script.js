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
    title: `Delete account`,
    text: `You are about to delete an account and all its related notes. It won't be possible to revert. Are you sure?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete account.'
  }).then((result) => {
    if (result.value) {
      Swal.fire(
        'Done',
        'The account has been deleted.',
        'success'
      )
    }
  })
}

