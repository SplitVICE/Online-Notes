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

// Reads plain-text string. Checks for links and images. Returns <a> and <img> tags arround 
// plain-text input if required.
function linkify(inputText) {
    // Source: https://stackoverflow.com/questions/49634850/javascript-convert-plain-text-links-to-clickable-links
    // Version 1.0
    var replacedText, replacePattern1, replacePattern2, replacePattern3, replacePattern4;

    //URLs starting with http://, https://, or ftp://
    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

    //Change img addresses to <img> tag.
	replacePattern4 = /(?<=>)(https?:\/\/\S+(?:png|jpe?g|gif)[^<]*)/g;
    replacedText = replacedText.replace(replacePattern4, '<img src="$1" class="note_image">');

    return replacedText;
}

// Checks all notes and checks if there are image links. If so, <img> tags are added.
const note_description_elements = document.getElementsByClassName("note_description");
for (var i = 0; i < note_description_elements.length; i++) {
    note_description_elements[i].innerHTML =
    linkify(note_description_elements[i].innerHTML);
} 
