<html>
<header></header>
	<body>


		<form id="upload" action="uploadXLS.php" method="POST"
			enctype="multipart/form-data">

			<fieldset>
				<legend>HTML File Upload</legend>

				<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE"
					value="300000" />

				<div>
					<label for="fileselect">Files to upload:</label>
					<input type="file"
						id="fileselect" name="fileselect[]" multiple="multiple" />
					<div id="filedrag">or drop files here</div>
				</div>

				<div id="submitbutton">
					<button type="submit">Upload Files</button>
				</div>

			</fieldset>
			<iframe id='my_iframe' name='my_iframe' src=""></iframe>

		</form>
		<script type="text/javascript">
		// file selection
		function FileSelectHandler(e) {

			// cancel event and hover styling
			FileDragHover(e);
			document.getElementById('upload').target = 'my_iframe';
			//'my_iframe' is the name of the iframe
			//document.getElementById('my_form').submit();

			// fetch FileList object
			var files = e.target.files || e.dataTransfer.files;

			// process all File objects
			for (var i = 0, f; f = files[i]; i++) {
				ParseFile(f);
				UploadFile(f);
			}

		}
		// upload JPEG files
		function UploadFile(file) {

			var xhr = new XMLHttpRequest();
			if (xhr.upload && file.type == "image/jpeg" && file.size <= $id("MAX_FILE_SIZE").value) {
				// start upload
				xhr.open("POST", $id("upload").action, true);
				xhr.setRequestHeader("X_FILENAME", file.name);
				xhr.send(file);

			}

		}
		</script>
	</body>

</html>