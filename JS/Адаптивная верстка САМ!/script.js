var myRequest;

if (window.XMLHttpRequest){
	myRequest = new XMLHttpRequest();
}else if (window.ActiveXObject){
		myRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}

myRequest.onreadystatechange = function(){
	console.log("We were called!");
}

myRequest.open('GET', 'simple.txt', true);

myRequest.send(null);