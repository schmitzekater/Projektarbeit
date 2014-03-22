<?php
 
// jQuery version of https://gist.github.com/3110728
 
/*
-- the SQL database table
create table form_ajax (
    ID varchar(5) not null,
    Name varchar(100),
    Address varchar(100),
    Phone varchar(20),
    Email varchar(255),
    constraint form_ajax_pk primary key (ID)
);
 
-- the data
insert into form_ajax(ID, Name, Address, Phone, Email)
values('123', 'Test Only', '123 Smith Street Jonestown 2000 NSW', '0123456789', 'test@example.com');
*/
 
// simplified to provide an example; deal with non-standards browsers yourself
// please use some common sense and add more structure, error handling, etc.
 
// NB: the PHP stuff is all server side, and is the AJAX service
 
// check for AJAX request
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'fetch') {
        // tell the browser what's coming
        header('Content-type: application/json');
 
        // open database connection
        $db = new PDO('mysql:dbname=genbank;host:localhost;', 'dbuser', 'dbuser');
 
        // use prepared statements!
        $query = $db->prepare('select * from form_ajax where ID = ?');
        $query->execute(array($_GET['ID']));
        $row = $query->fetch(PDO::FETCH_OBJ);
 
        // send the data encoded as JSON
        echo json_encode($row);
        exit;
    }
}
 
?>
<!DOCTYPE html>
<html lang="en-au">
<head>
<meta charset="utf-8" />
<title>Form from AJAX using jQuery</title>
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>
 
// NB: the JavaScript stuff here is all client side and is the AJAX client
 
// encapsulate the lot within a function scope called on document ready
jQuery(function($) {
 
    // hook the submit action on the form
    $("#form-ajax").submit(function(event) {
        // stop the form submitting
        event.preventDefault();
 
        // grab the ID and send AJAX request if not (empty / only whitespace)
        var ID = this.elements.ID.value;
        if (/\S/.test(ID)) {
 
            // using the ajax() method directly
            $.ajax({
                type : "GET",
                url : url,
                cache : false,
                dataType : "json",
                data : data,
                success : process_response,
                error: function(xhr) { alert("AJAX request failed: " + xhr.status); }
            });
 
            // there is a shortcut method to GET JSON:
            // $.getJSON(url, data, process_response);
        }
        else {
            alert("No ID supplied");
        }
    };
 
    /**
    * process the response, populating the form fields from the JSON data
    * @param {Object} response the JSON data parsed into an object
    */
    function process_response(response) {
        var frm = $("#form-ajax");
        var i;
 
        console.dir(response);      // for debug
 
        for (i in response) {
            frm.find('[name="' + i + '"]').val(response[i]);
        }
    }
 
});
 
</script>
 
</head>
 
<body>
 
    <form id="form-ajax" action="jsontest.php">
        <label>ID:</label><input type="text" name="ID" /><br />
        <label>Name:</label><input type="text" name="Name" /><br />
        <label>Address:</label><input type="text" name="Address" /><br />
        <label>Phone:</label><input type="text" name="Phone" /><br />
        <label>Email:</label><input type="email" name="Email" /><br />
        <input type="submit" value="fill from db" />
    </form>
 
</body>
 
</html>