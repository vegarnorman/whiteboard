$(function() {

	$(".post-editor-tag-add").click(function() {
		if ($(".post-editor-new-tag").val() != "") {
			var tag = "<span class=\"tag\">" + $(".post-editor-new-tag").val() + "</span>";
			$(".post-editor-current-tags").append(tag);
			$(".post-editor-new-tag").val("");
		}
		return false;
	})

	$(".tag").click(function() {
		$(this).remove();
	})

});