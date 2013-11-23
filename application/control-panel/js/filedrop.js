$(function() {

		// Lag filedrop-kode dynamisk
		$(".cp-main").append("<div class=\"cp-filedrop grid g12\" id=\"cp-filedrop\" />");
		$(".cp-filedrop").append("<p class=\"cp-filedrop-status\">Slipp en tekstfil her for å publisere!</p>");

		// Sett tom variabel for innhold i fil
		var fileContent = "";

		// Når en fil dras over filedrop-området, skal scriptet overstyre nettleseren.
		// Sett også en annen bakgrunnsfarge på feltet for bedre affordance.
		function filedropDragover(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			evt.dataTransfer.dropEffect = "copy";

			$("#cp-filedrop").css({"background-color": "#b2d2ff"});
		}		

		// Det som skjer når fila faktisk slippes inn i filedrop-feltet
		function filedropDropAction(evt) {

			// Overstyr nettleseren
			evt.stopPropagation();
			evt.preventDefault();

			// Hent filen som ble sluppet (teknisk sett filene, men siden vi sender informasjonen til neste side så fort den første er lastet, blir bare én fil behandlet.)
			var files = evt.dataTransfer.files;


			for (var i = 0; i < files.length; i++) {

				// Hent filen og lag en ny FileReader
				var file = files[i];
				var reader = new FileReader();

				// Magien: Hent ut dataene fra filen som ble sluppet inn i applikasjonen...
				reader.onload = (function(theFile) {
					return function(e) {

						// ...men bare om det er en tekstfil. Ellers, gi en advarsel og ikke gjør noe mer.
						if (file.type.match('text.*')) {

							// Hent ut dataene og legg dem i en string som kan JSON-parses. Konverter linjeskift; jQuery liker ikke slashes.
							fileContent = '{ "post_data": "' +  e.target.result +  '" }';
							fileContent = fileContent.replace(/\r\n/g, '<br />');
							fileContent = fileContent.replace(/\n/g, '<br />');

							// Legg inn et skjema som skal sende dataene avgårde.
							$("body").append('<form id="cp-filedrop-action" action="editor.php" method="post" />');
							$("#cp-filedrop-action").append('<input type="hidden" name="filedrop_content" id="filedrop_content" />');

							// MERK! Denne må settes i vanilla Javascript - jQuery får JSON-parsingen til å hoste.
							document.getElementById("filedrop_content").setAttribute("value", fileContent);

							// Send i vei!
							$("#cp-filedrop-action").submit();

						}

						else {
							alert("Beklager, dette er ikke en fil på gyldig format.");
							return false;
						}
						
					};
				})(file);

				// FileReader'en skal lese filen som tekst.
				reader.readAsText(file);
			}
		}

		// Legg filedrop-elementet i en variabel og bind påkrevde event listeners til den. 
		var filedrop = document.getElementById("cp-filedrop");
		filedrop.addEventListener("dragover", filedropDragover, false);
		filedrop.addEventListener("drop", filedropDropAction, false);
		filedrop.addEventListener("change", filedropDropAction, false);

});