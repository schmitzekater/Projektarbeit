function displayAcceptedExtensions() {
    /**
     * This function sets the accepted file-extensions.
     */
    var display = [];
    var acceptedExtensions = ['xls', 'pdf', 'txt', 'csv'];
    acceptedExtensions.toString();
    display.push('<p>Accepted File-Extensions: </p>');
    for (var i = 0; i < acceptedExtensions.length; ++i) {
        a = acceptedExtensions[i];
        if (i == acceptedExtensions.length - 1) {
            display.push(a);
        } else
            display.push(a, ', ');
    }
    display.push('</p>');
    //document.getElementById('extensions').innerHTML = display.join('');
    $( "#acceptedExtensions" ).append(display.join(''));  // ACHTUNG!! Laesst sich mehrfach anhaengen! 
    /*
     * TODO: Abfrage, ob schon angehangen wurde, dann nicht mehr!!
     */
}

function handleFileSelect(evt) {
    /*
     * This functions set the upload.interface.
     * It accepts files depending on the file format.
     */
    var output = [];

    var files = evt.target.files;
    // FileList object

    // files is a FileList of File objects. List some properties.
    for (var i = 0, f; f = files[i]; i++) {
        //Get the file-extension of the file
        var ending = f.name.substring(f.name.lastIndexOf('.') + 1);
        //If file ending is accepted on server-side, add it to upload-list.
        output.push('<p>', ending, '</p>');
        if (ending.toUpperCase() == ('PDF')) {
            output.push('Mäh');
        }
        output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ', f.size, ' bytes, last modified: ', f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
    if (files.length > 0) {
        document.getElementById('upload').disabled = false;
    }
    else {
         document.getElementById('upload').disabled = true;
    }

    //document.getElementById('files').addEventListener('change', handleFileSelect, false);
}
function toggleElement(elementName) {
            $(elementName).slideToggle(150);
        }
function clearUploadList() {
    /**
     * This function clears the Upload List. It deactivates the Upload-Button on empty list.
     */
    files = null;
    document.getElementById('fileselect').value = '';
    document.getElementById('list').innerHTML = '';
    document.getElementById('upload-button').disabled = true;
}