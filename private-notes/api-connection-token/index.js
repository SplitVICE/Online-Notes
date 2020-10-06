const btn_toggleApiVisible = document.getElementById("btn_toggleApiVisible");
const apiConnectionTokenHidden = document.getElementById("apiConnectionTokenHidden");
const apiConnectionToken = document.getElementById("apiConnectionToken");
let = apiConnectionToken_isVisible = false;

// Makes the API Connection Token visible or not visible.
function apiConnectionToken_toggleVisible() {
    if (!apiConnectionToken_isVisible) { // if not visible.
        apiConnectionTokenHidden.style.display = "none";
        apiConnectionToken.style.display = "inline";
        apiConnectionToken_isVisible = true;
        btn_toggleApiVisible.innerHTML = "Hide API Connection Token";
    } else { // if visible.
        apiConnectionTokenHidden.style.display = "inline";
        apiConnectionToken.style.display = "none";
        apiConnectionToken_isVisible = false;
        btn_toggleApiVisible.innerHTML = "Show API Connection Token";
    }
}

// Initial code execution. Makes API Connection Token not visible.
function main() {
    apiConnectionTokenHidden.style.display = "inline";
    apiConnectionToken.style.display = "none";
}

main();

// ================================================================================================
// ================================================================================================
// ================================================================================================
// Delete API Connection Token.
function delete_apiConnectionToken() {
    Swal.fire({
        title: 'Delete API Connection Token',
        text: "Your API Connection Token will be deleted. All software you have using it will enter in 500 error state. You can always create a new API Connection Token. Are you sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it'
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = "./delete-api-connection-token.php";
        }
    })
}