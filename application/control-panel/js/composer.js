$(function() {

	//	JSON-PARSER
	//	Noe enklere da det ikke er emneord eller kategorier på statiske sider
	//=======================================================================

	if (edit !== "") {
		var page = jQuery.parseJSON(edit);
		console.log(page);

		$("#page_title").val(page.page_title);
		$("#page_data").val(page.page_data);
	}


	//	TEKSTREDIGERING
	//=================
	

	//	Funksjon for å wrappe tekst i tekstområdet med markdown-tagger

	function wrapText(openTag, closeTag) {
	    var textArea = $(".post-editor-content");
	    var len = textArea.val().length;
	    var start = textArea[0].selectionStart;
	    var end = textArea[0].selectionEnd;
	    var selectedText = textArea.val().substring(start, end);
	    var replacement = openTag + selectedText + closeTag;
	    textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
	}


	//	De faktiske funksjonene som brukes i toolbar'en

	function makeBold() {
		wrapText("**", "**");
	}

	function makeItalic() {
		wrapText("*", "*");
	}

	function makeUnderlined() {
		wrapText("__", "__");
	}

	function makeLink() {
		var url = prompt("Vennligst skriv inn URL:", "http://");
		wrapText("[", "](" + url + ")");
	}

	function makeCode() {
		wrapText("```\n", "\n```");
	}

	$("#editor-bold").click(function() {
		makeBold();
		return false;
	});

	$("#editor-italic").click(function() {
		makeItalic();
		return false;
	});

	$("#editor-underline").click(function() {
		makeUnderlined();
		return false;
	});

	$("#editor-link").click(function() {
		makeLink();
		return false;
	});

	$("#editor-code").click(function() {
		makeCode();
		return false;
	});



	//	DISTRACTION-FREE EDITING
	//==========================


	var distraction_free = false;

	$("#editor-distraction-free").click(function() {

		if (distraction_free) {

			$(".post-editor-main").removeClass("post-editor-distraction-free");
			$(".cp-sidebar, .post-editor-meta").removeClass("hidden");

			$(".cp-sidebar, .post-editor-meta").animate({
				opacity: 1
			}, 500, function() {
				
			});


			$("#editor-distraction-free").css({
				"background-color": "rgba(14, 15, 20, 0)", "color": "rgba(14, 15, 20, 0.8)"
			});

			distraction_free = false;
		}

		else {

			$(".cp-sidebar, .post-editor-meta").animate({
				opacity: 0
			}, 500, function() {
				$(this).addClass("hidden");
				$(".post-editor-main").addClass("post-editor-distraction-free");
			});

			$("#editor-distraction-free").css({
				"background-color": "rgba(14, 15, 20, 0.7)", "color": "#0058e5"
			});

			distraction_free = true;
		}

		return false;

	});



	//	SUBMIT-SCRIPT
	//===============

	$("#editor_submit").click(function() {
		if ($(".post-editor-title").val() === "" || $(".post-editor-content").val() === "") {
			alert("Tittel og innhold må være utfylt. Vennligst korriger og forsøk igjen.");
			return false;
		}

		else {
			return true;
		}
	});	

});