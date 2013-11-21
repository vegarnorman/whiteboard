$(function() {

	if (edit !== "") {
		edit = edit.replace(/<br \/>/g, "\\n");
		var post = jQuery.parseJSON(edit);
		console.log(post);

		$("#post_title").val(post.post_title);
		$("#post_data").val(post.post_data);

		$.each(post.post_tags, function(key, value) {
			var tag = '<span class="tag">' + value + '</span>';
			$(".post-editor-current-tags").append(tag);
		});

		for (var i = 0; i < post.post_categories.length; i++) {
			$("input#" + post.post_categories[i]).attr("checked", true);
		}
	}


	$(".post-editor-tag-add").click(function() {
		if ($(".post-editor-new-tag").val() !== "") {
			var tag = "<span class=\"tag\">" + $(".post-editor-new-tag").val() + "</span>";
			$(".post-editor-current-tags").append(tag);
			$(".post-editor-new-tag").val("");
		}
		return false;
	});

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

		if ($(".post-editor-title").val() === "" || $(".post-editor-content").val() === "") {
			alert("Tittel og innhold må være utfylt. Vennligst korriger og forsøk igjen.");
			return false;
		}
		
		var number_of_tags = $(".post-editor-current-tags .tag").length;
		var number_of_categories = $(".post-editor-categories input:checked").length;

		if (number_of_tags > 0) {
			var tag_html = $(".post-editor-current-tags .tag").toArray();
			var tag_list = new Array();
			
			for (var i = 0; i < number_of_tags; i++) {
				var keyword = tag_html[i].innerHTML;
				tag_list[i] = keyword;
			}

			$("input#post_tags").val(JSON.stringify(tag_list));

		}
		
		if (number_of_categories > 0) {
			var categories_html = $(".post-editor-categories input:checked").toArray();
			var category_list = new Array();

			for (var i = 0; i < number_of_categories; i++) {
				var categoryID = $(categories_html[i]).attr("value");
				category_list[i] = categoryID;
			}

			$("input#post_categories").val(JSON.stringify(category_list));

		}
		

		return true;

	});	

});