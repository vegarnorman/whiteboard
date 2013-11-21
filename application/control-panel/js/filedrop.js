$(function() {

		var fileContent = "";

		function filedropDragover(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			evt.dataTransfer.dropEffect = "copy";

			$("#cp-filedrop").css({"background-color": "#b2d2ff"});
		}		

		function filedropDropAction(evt) {
			evt.stopPropagation();
			evt.preventDefault();

			var files = evt.dataTransfer.files;

			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				var reader = new FileReader();

				reader.onload = (function(theFile) {
					return function(e) {
						fileContent = '{ "post_data": "' +  e.target.result +  '" }';
						fileContent = fileContent.replace(/\n/g, '<br />');
						form = document.createElement("form");
						form.setAttribute("method", "post");
						form.setAttribute("action", "editor.php");
						content = document.createElement("input");
						content.setAttribute("name", "filedrop_content");
						content.setAttribute("id", "filedrop_content");
						content.setAttribute("value", fileContent);
						form.appendChild(content);
						document.body.appendChild(form);
						form.submit();
					};
				})(file);

				reader.readAsText(file);
			}
		}
	

		var filedrop = document.getElementById("cp-filedrop");
		filedrop.addEventListener("dragover", filedropDragover, false);
		filedrop.addEventListener("drop", filedropDropAction, false);
		filedrop.addEventListener("change", filedropDropAction, false);

});