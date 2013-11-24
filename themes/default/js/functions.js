
//highligts current menu item
window.onload = function highlight(){
	//get url
	var url = document.URL;
	//put all links in an array
	var current = document.getElementsByTagName('a');
	for (var i = 0; i < current.length; i++) {
		if (current[i] == url){
			if (current[i].parentNode.className=="menu") {
				current[i].parentNode.setAttribute("class", "highlight");
			}
		}
	}
};




// //hide comment form on load
document.ready = function hideDiv(){
	var div = document.getElementById('comment-box');
	if (div !== null) {
		div.style.display='none';
	}
};




//
//			VALIDERING AV INPUTSKJEMA
//



function validateForm(){

	var name = document.commentForm.user.value;
	var mail = document.commentForm.mail.value;
	var comment = document.commentForm.comment.value;
	
	if (name === "") {
		document.getElementById("error").innerHTML="Feltet må være fylt ut";
		document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.user.setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.user.focus();
		return false;
	}
	else if (mail === "" || mailCheck() !== true){
		document.getElementById("error").innerHTML="Feltet må være fylt ut";
		document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.mail.setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.mail.focus();
		return false;
	}
	else if (comment === ""){
		document.getElementById("error").innerHTML="Feltet må være fylt ut";
		document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.comment.setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.comment.focus();
		return false;
	}
	else{
		return true;
	}
	
}


function nameCheck(){
	var input = document.commentForm.user.value;
	if (input !== "") {
		document.commentForm.user.setAttribute("style","border:1px solid rgb(99, 233, 99);");
		document.getElementById("error").setAttribute("style","border:0;");
		document.getElementById("error").innerHTML="";
	}
	else{
		document.getElementById("error").innerHTML="Feltet må være fylt ut";
		document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.user.setAttribute("style","border:1px solid #FF3F3F;");
	}
}




function mailCheck(){
 	var	regEx = /^[a-zA-ZæøåÆØÅ0-9_-]+@[a-zA-ZæøåÆØÅ0-9]+(\.[a-z0-9-]+)*(\.[a-zæøå]{2,4})$/;
	var ok = regEx.test(document.commentForm.mail.value);
	
	var input = document.commentForm.mail.value;
	if (input !== "") {
		if(!ok){
			document.getElementById("error").innerHTML="Epostadressen er ugyldig";
			document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
			return false;
		}
		else{
			document.commentForm.mail.setAttribute("style","border:1px solid rgb(99, 233, 99);");
			document.getElementById("error").setAttribute("style","border:0;");
			document.getElementById("error").innerHTML="";
			return true;
		}
	}
	else{
		document.getElementById("error").innerHTML="Feltet må være fylt ut";
		document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.mail.setAttribute("style","border:1px solid #FF3F3F;");
		return false;
	}
	return true;
}


function commentCheck(){
	var input = document.commentForm.comment.value;
	if (input !== "") {
		document.commentForm.comment.setAttribute("style","border:1px solid rgb(99, 233, 99);");
		document.getElementById("error").setAttribute("style","border:0;");
		document.getElementById("error").innerHTML="";
	}
	else{
		document.getElementById("error").innerHTML="Feltet må være fylt ut";
		document.getElementById("error").setAttribute("style","border:1px solid #FF3F3F;");
		document.commentForm.comment.setAttribute("style","border:1px solid #FF3F3F;");
	}
}






// Easter Egg Marius

var input = document.getElementsByTagName("input");


function popupwindow() {

	var url = "http://www.empireonline.com/images/uploaded/chuck-norris-uzis.jpg";
	window.open(url);
  return false;
} 

$(document).ready (function() {
	$('form').submit(function(event) {
		if (input[0].value === ("Chuck Norris") ) {
		popupwindow();
		event.preventDefault();
		}
	});
	return false;
});




