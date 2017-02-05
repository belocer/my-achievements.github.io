window.onload = function() {
	
	var showed = false;
	
	document.onscroll = function(){
		var sum = window.pageYOffset + window.innerHeight;
		
		if( !showed && sum > 1300 ){
			showed = true;
			document.querySelector('.test').className += ' animated';
		}
	}
	
	
}