<?php
$uploaddir = './alex/uploads/';
$uploadfile = $uploaddir . basename ( $_FILES ['my_files'] ['name'] );
echo("File: ". basename ( $_FILES ['my_files'] ['name'])."\nPfad: ".$uploadfile);
if (move_uploaded_file ( $_FILES ['tmp_name'] ['name'], $uploadfile )) {
	echo "success";
} else {
	echo "error";
}
?>