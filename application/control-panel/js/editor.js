$(function() {

	//	EMNEORD
	//=========


	//	Legger til emneord-seksjonen på editorsiden

	$(".post-editor-section-tags").append('<h3>Emneord</h3>');
	$(".post-editor-section-tags").append('<p class="post-editor-help">Trykk på et emneord for å slette det</p>');
	$(".post-editor-section-tags").append('<div id="post-editor-current-tags" class="post-editor-current-tags" />');
	$(".post-editor-section-tags").append('<div class="row post-editor-tags" />');
	$(".post-editor-tags").append('<input type="text" id="post-editor-new-tag" placeholder="Nytt emneord" class="grid g9 no-gutters post-editor-new-tag" />');
	$(".post-editor-tags").append('<button id="post-editor-tag-add" class="grid g3 no-gutters post-editor-tag-add button green"><i class="fa fa-plus-circle"></i></button>');


	//	Håndterer tillegg og sletting av emneord

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

	

	//	JSON-PARSER
	//	Henter data fra et JSON-objekt og fyller 
	//	ut editoren for videre redigering
	//==============================================

	if (edit !== "") {
		edit = edit.replace(/<br \/>/g, "\\n");
		var post = jQuery.parseJSON(edit);

		$("#post_title").val(post.post_title);
		$("#post_data").val(post.post_data);

		if (post.post_tags !== undefined) {
			$.each(post.post_tags, function(key, value) {
				var tag = '<span class="tag">' + value + '</span>';
				$(".post-editor-current-tags").append(tag);
			});
		}

		if (post.post_categories !== undefined) {
			for (var i = 0; i < post.post_categories.length; i++) {
				$("input#" + post.post_categories[i]).attr("checked", true);
			}
		}
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