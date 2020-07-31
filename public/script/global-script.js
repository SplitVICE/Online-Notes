function copy_text_to_clipboard(text_to_copy){
    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text_to_copy;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}
