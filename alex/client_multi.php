<!---------------------------------------------------------------------------
Example client script for JQUERY:AJAX -> PHP:MYSQL example
---------------------------------------------------------------------------->

<html>
<head>
<script language="javascript" type="text/javascript" src="jquery.js"></script>
</head>
<body>

	<!-------------------------------------------------------------------------
  1) Create some html content that can be accessed by jquery
  -------------------------------------------------------------------------->
	<h2>Client example</h2>
	<h3>Output:</h3>
	<div id="output">this element will be accessed by jquery and this text
		replaced</div>

	<script id="source" language="javascript" type="text/javascript">

  $(function ()
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    $.ajax({
      url: 'api_multi.php',                  //the script to call to get data
      data: "test='ja'",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format
      success: function(data)          //on recieve of reply
      {
    	//var multiData = {events: data};
    	table = "<table border ='1'><tr><td>ID</td><td>Change</td><td>AA Change</td><td>ExtraInfo</td><td>GenId</td><td>Phenotype</td><td>Protein</td><td>Nucleotide</td><td>Ref</td></tr>";
    	trStart = "<tr><td>";
    	tdMiddle = "</td><td>";
    	trEnd = "</td></tr>";
    	tableEnd = "</table>";
    	$.each( data,
    	    	function(i, item) {
    			//alert( data[i].start );}
			table += trStart+data[i].id+tdMiddle+data[i].change+tdMiddle+data[i].aa+tdMiddle+data[i].extra+tdMiddle+data[i].genId+tdMiddle+data[i].pheno+tdMiddle+data[i].protein+tdMiddle+data[i].nuc+tdMiddle+data[i].ref+trEnd;}
		);
		table +=tableEnd;
		
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
       //$('#output').html("<b>id: </b> Ich laber hier Kacke!!!");
        $('#output').html(table); //Set output element html
        //recommend reading up on jquery selectors they are awesome
        // http://api.jquery.com/category/selectors/
      }
    });
  });

  </script>
</body>
</html>