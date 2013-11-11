$(function() {

	$(".post-editor-tag-add").click(function() {
		if ($(".post-editor-new-tag").val() != "") {
			var tag = "<span class=\"tag\">" + $(".post-editor-new-tag").val() + "</span>";
			$(".post-editor-current-tags").append(tag);
			$(".post-editor-new-tag").val("");
		}
		return false;
	})

	$("body").on("click", ".tag", function() {
		$(this).remove();
	});

	function wrapText(openTag, closeTag) {
	    var textArea = $(".post-editor-content");
	    var len = textArea.val().length;
	    var start = textArea[0].selectionStart;
	    var end = textArea[0].selectionEnd;
	    var selectedText = textArea.val().substring(start, end);
	    var replacement = openTag + selectedText + closeTag;
	    textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len));
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
	})

	$("#editor-link").click(function() {
		makeLink();
		return false;
	});

	$("#editor-code").click(function() {
		makeCode();
		return false;
	});


	$(".post-editor-content").on("keydown", function(e) {
		var key = e.which || e.keyCode;

		if (key == 9) {
			wrapText("\t", "");
			e.preventDefault();
		}
	});





});