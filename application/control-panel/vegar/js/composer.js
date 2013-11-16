$(function() {

	if (edit !== "") {
		var page = jQuery.parseJSON(edit);
		console.log(page);

		$("#page_title").val(page.page_title);
		$("#page_data").val(page.page_data);
	}

	function wrapText(openTag, closeTag) {
	    var textArea = $(".post-editor-content");
	    var len = textArea.val().length;
	    var start = textArea[0].selectionStart;
	    var end = textArea[0].selectionEnd;
	    var selectedText = textArea.val().substring(start, end);
	    var replacement = openTag + selectedText + closeTag;
	    textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
	}

	function makeHeading() {
		wrapText("## ", "\n");
	}

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

	function makeUnordered() {
		wrapText("+ ", "");
	}

	function makeCode() {
		wrapText("```\n", "\n```");
	}


	$("#editor-heading").click(function() {
		makeHeading();
		return false;
	});

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


	$("#editor_submit").click(function() {
		return true;
	});	

});