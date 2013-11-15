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
