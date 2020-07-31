function sweetAlert_success(modal_description){
    Swal.fire({
        icon: 'success',
        title: modal_description,
        showConfirmButton: false,
        timer: 1000
      })
}