
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






// melding til bruker 
function free(){
	var mail = document.commentForm.mail;
		document.getElementById("free").setAttribute("style", "color:#444040;");
		document.getElementById("free").innerHTML="Kommentaren kan postes!";
}


function free2(){
	var mail = document.commentForm.mail;
		document.getElementById("free").setAttribute("style", "color:#EEE;");
		document.getElementById("free").innerHTML="Kommentaren kan postes!";
}




//
//		forslag til easteregg
//
var clickCount = 0;

function meshUp(){

	$("#submit").click(function(){
		clickCount++;
	});
			//alert(clickCount);

	if (name === "" && clickCount==2){
		document.getElementById("error").innerHTML="You fucked up!!";
		document.getElementById('comment-box').setAttribute("style",";-webkit-transform:rotate(2deg);");
	}
	else if(name === "" && clickCount==5){		
		document.commentForm.user.setAttribute("style","background-color: yellow;-webkit-transform:rotate(-17deg);");
		document.commentForm.mail.setAttribute("style","background-color: blue;-webkit-transform:rotate(-68deg);");
		document.getElementById('comment-box').setAttribute("style","-webkit-transform:rotate(10deg);background-color:#DDD");
		document.getElementById('error').setAttribute("style","font-size: 59px;color:red;-webkit-transform:rotate(-34deg)");

	}
	else if(name === "" && clickCount==9){
		document.getElementById("error").innerHTML="YOU FUCKED UP!!!";
		document.getElementById('error').setAttribute("style","font-size: 80px;color:red;font-weight:900;-webkit-transform:rotate(-17deg)");
		document.commentForm.mail.setAttribute("style", "background-color: purple; height: 150px;width:30px;");
		document.commentForm.comment.setAttribute("style", "-webkit-transform:rotate(90deg);width:10px;");
	}	
	else if(name === "" && clickCount==14){
		document.getElementById('comment-box').setAttribute("style","-webkit-transform:rotate(17deg);background-color: green;width: 100px;height:200px;background-color:blue;");
	}

	else if(name === "" && clickCount==20){
		document.getElementById('comment-box').setAttribute("style","background-color: black");
		document.getElementById('error').setAttribute("style","font-size: 39px;color:red;-webkit-transform:rotate(-34deg)");

	}

	 else if(name === "" && clickCount==27){
		document.commentForm.user.setAttribute("style","background-color: #DDD;-webkit-transform:rotate(-180deg);");
		document.commentForm.mail.setAttribute("style","background-color: #DDD;-webkit-transform:rotate(180deg);");
		document.commentForm.comment.setAttribute("style", "-webkit-transform:rotate(180deg)");
		document.commentForm.submit_comment.setAttribute("style", "-webkit-transform:rotate(180deg)");
		document.getElementById("error").innerHTML="";
		document.getElementById('comment-box').setAttribute("style","-webkit-transform:rotate(0deg);background-color:#EEE;width:535px;heigth:auto;");
		document.getElementById('error').setAttribute("style","font-size: 18;color:red;-webkit-transform:rotate(-34deg)");

	}
	// else if(name === "" && clickCount==35){}
 	return false;
}




// Easter Egg Marius

var input = document.getElementsByTagName("input");


function popupwindow() {
	var url = "http://www.empireonline.com/images/uploaded/chuck-norris-uzis.jpg";
  window.open(url);
} 

 function vis() {
	if (input[0].value === ("Chuck Norris") || ("chuck norris") ) { //sjekker om navnet er Chuck Norris
	(validateForm()==false);
	popupwindow();
	}
}




