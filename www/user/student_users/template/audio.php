<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="content"></div>
	<script>
		
		// Load the initial page content
		loadPage("./pick_language.php");

		// Function to load a page via AJAX and replace the content
		function loadPage(url) {
			var xhr = new XMLHttpRequest();
			xhr.open("GET", url);
			xhr.onload = function() {
				document.getElementById("content").innerHTML = xhr.responseText;
			};
			xhr.send();
		}
	</script>
</body>
</html>
