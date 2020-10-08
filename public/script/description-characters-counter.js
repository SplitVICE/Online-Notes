let noteLengthError_messageTooLarge_hasBeenShowed = false;

// Updates the counter of max characters the database can handle
// regarding how long the note description is.
function characters_counter() {
    const max_characters = 100000;
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