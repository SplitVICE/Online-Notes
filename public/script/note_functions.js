function copy_text_to_clipboard(text_to_copy) {
    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text_to_copy;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}

function writeANewNote_openCollapse() {
    document.getElementById('collapse_button').click();
}

function scrollIntoView_btnSubmitNote() {
    setTimeout(() => {
        document.getElementById('btn_submitNote').scrollIntoView();
    }, 200);
}

// ===================
// Image handler

// Receives a string which has a image URL inside the plaintext then returns
// same string but adds <img> to the image URL.
// Example: Hello i.imgur.com/image word -> Returns: Hello <img src="i.imgur.com/image" /> word.
function regexMatcher_addImgTagToPlainTextString(plain_text) {
    // Source: https://stackoverflow.com/questions/38349684/javascript-plugin-for-finding-images-links-in-plain-text-and-converting-them-to
    const regexp = /\b(https?:\/\/\S+(?:png|jpe?g|gif)\S*)\b/ig;
    const replace = `
    <a target='_blank' href="$1">
        <img class='note_image' src='$1'>
    </a>
    `;
    return plain_text.replace(regexp, replace);
}

// Checks all notes and checks if there are image links. If so, <img> tags are added.
const note_description_elements = document.getElementsByClassName("note_description");
for (var i = 0; i < note_description_elements.length; i++) {
    note_description_elements[i].innerHTML =
        regexMatcher_addImgTagToPlainTextString(note_description_elements[i].innerHTML);
} 
