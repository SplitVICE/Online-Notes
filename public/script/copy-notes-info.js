function copyTitleToClipboard(id) {
    note_title_id = "note_title_" + id
    const title = document.getElementById(note_title_id).innerText
    copy_text_to_clipboard(extractTitle(title));
    sweetAlert_success("Title copied into clipboard");
}

function copyDescriptionToClipboard(id) {
    note_description_id = "note_description_" + id
    const desc = document.getElementById(note_description_id).innerText
    copy_text_to_clipboard(desc);
    sweetAlert_success("Description copied into clipboard");
}

/**
 * Titles are shown on canvas as [title] - [date]. This function
 * recibes a title with this format and returns only [title].
 * @param {string} input Title input to extract actual title.
 */
function extractTitle(input){
    const regex = /^.*(?=(\ - 202))/gm;
    let regexResult;
    while ((regexResult = regex.exec(input)) !== null) {
        if (regexResult.index === regex.lastIndex) {
            regex.lastIndex++;
        }
        return regexResult[0];
    }
}