$(function() {

	//	NY KATEGORI
	//=============

	$("#new_category #submit").click(function() {
		if ($("#new_category_name").val() === "") {
			alert("Du må skrive inn et kategorinavn. Vennligst forsøk igjen.");
			return false;
		}
	});
	
});
