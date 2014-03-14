/**
 * Suggestions
 * 
 * 
 */

var maxSize = 1024*1024; // 1 KB

/**
 * Creates a new iframe as the form target if it doesn't exist yet and submits
 * the form
 */
function sendForm()
{
  setStatus("Sending...", 2/4);
  if ( !$("iframe[name=ifrUpload]")[0] )
    $( "#dialog" ).append("<iframe name='ifrUpload' width='1px' height='1px' style='display: none'></iframe>");
  
  $( "#frmUpload" ).attr("target", "ifrUpload")
                   .get(0).submit();
}

/**
 * Send the file
 */
function sendFile(file, fileName)
{
  setStatus("Reading...", 1/4);

  
  readFile(file, function(file, evt)
  {
    setStatus("Sending...", 2/4);
    
    // Build MD5 ans SHA1 hashes
    var md5_hash = hex_md5(evt.target.result);
    var sha1_hash = hex_sha1(evt.target.result);
    
    // Send the data via AJAX
    $.ajax(
    {
      type: "POST",
      url: "jquery.php",
      data: ( "file=" + encodeURIComponent(evt.target.result)+"&filename=" +fileName),
     // data: ( "file=" + evt.target.result+"&filename=" +fileName),
      
      // On success
      success: function(response)
      {
        // Try parsing the JSON
        try
        {
          var json = JSON.parse(response);
          
          if ( json['file_uploaded'] == true )
          {
            if ( json['error'] == true ) // If an error occurred
            {
              setStatus("Error ("+json['errno']+")", 1, true);
            }
            else // No error
            {
              setStatus("Verifying...", 3/4);
              
              // Compare the hashes
              if (json['md5'] == md5_hash &&
                  json['sha1'] == sha1_hash)
              {
                setStatus("Finished!"+json['quelle'], 1);
              }
              else
              {
                setStatus("File not correctly uploaded!"+json['quelle'], 1, true);
              }
            }     
          }
          else // If no file was uploaded
          {
            setStatus("File not uploaded!", 1, true);
          }
        }
        catch (e)
        {
          setStatus("Server returned invalid JSON!", 1, true);
        }
      }
    }); // End AJAX
  });  // End readFile()
}

// on loading
$(function()
{
  $( "#dialog" ).dialog( {modal:false, minWidth: 400} );
  
  $( "#btnUpload" ).button().click(function()
  {          
    var input = document.getElementById("file_input");
    
    // Check if the File API is supported
    if ( typeof FileReader=="undefined" || !input.files  )
    {
      // If the File API is not supported but the users still wished to send
		// the file via form and iframe
      if ( $("#cbNotSupported:checked").val() != undefined )
      {
        sendForm();
      }
      else  // Otherwise the user sees an error message
      {
        setStatus("Your browser doesn't support the HTML 5 File API!", 0, true);
      }
      return false;
    }
    
    // Check if a file was selected
    if ( input.files.length < 1 )
    {
      setStatus("Please select a file!", 0, true);
      return false;
    }
    
    // If maxSize is greater than size, use an iFrame for sending the file
    if (input.files[0].size > maxSize)
    {
      if ( $("#cbUseIFrame:checked").val() == undefined ) // If the user
															// doesn't want to
															// use iframes
      {
        setStatus("File too large (maxSize is "+maxSize+")! Activate the IFrame option.", 1, true);
      }
      else // Send the form (create a new iframe if it doesn't exist yet and
			// submit the form)
      {
        sendForm(input.files[0]);
      }
    }
    
    // Use an AJAX request for sending the file
    else
    {
    	/*
		 * TODO: Provve CSV;
		 */
    	fileName = input.files[0].name;
    	fileName = fileName.substring(0, fileName.lastIndexOf('.') );
      // sendFile(input.files[0], fileName);
      sendFile(input.files[0], filename);
    }
    return false;
    
  });  // End button onclick
});  // End DOM onload

/**
 * Reads a file object using the FileReader and calls the callback function
 * 
 * @param file
 *            The file object, e.g. from an input file field
 * @param callback
 *            An optional callback function which is called with the file and
 *            event object ( function(file, evt){} )
 */
function readFile(file, callback)
{
  var reader = new FileReader();
  reader.onload = function(evt)
  {
    if (typeof callback=="function")
      callback(file, evt);
  };
  reader.onerror = errorHandler;
  // reader.readAsBinaryString( file );
   reader.readAsText( file );
  // reader.readAsArrayBuffer( file );
 // reader.readAsDataURL( file );
}

/**
 * The error handler for the FileReader
 * 
 * @param evt
 *            The event object
 * @uses setStatus()
 */
function errorHandler(evt)
{
  setStatus("Error during reading: "+evt.target.error.code, 0, true);
}

/**
 * Updates the status to `msg` and the progressbar to `value`
 * 
 * @param msg
 *            The message to display in text format. It may contain newline
 *            characters which will be replaced by <br />.
 * @param value
 *            The new value for the progressbar between 0 and 1. It is
 *            multiplied by the `max` attribute of the progressbar
 * @param error
 *            If TRUE the statusWrapper div will get the `ui-state-error` style,
 *            otherwise the `ui-state-highlight` style from jQuery UI.
 */
function setStatus(msg, value, error)
{
  if (error==null) error = false;
  
  msg = msg.replace(/\n/g, "<br />");
  
  $("#status").html(msg);
  
  var shownAsError = $("#status").hasClass("ui-state-error");
  
  if ( error==true )
  {
    $("#statusWrapper").attr("class", "ui-state-error");
  }
  else
  {
    $("#statusWrapper").attr("class", "ui-state-highlight");
  }
  
  $("#pgrStatus").val( value*$("#pgrStatus").attr("max") );
}

/**
 * This function is called from output source of all.php in the IFrame (only
 * when size was greater than maxSize)
 * 
 * @param json
 *            The JSON
 */
function iframeLoaded(json)
{
  // If an error occurred
  if ( json.error )
  {
    setStatus("Error from PHP script ("+json.errno+")", 1, true);
  }
  else
  {
    setStatus("Finished!", 1);
  }
}