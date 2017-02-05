
window.onload = function(){
	var time = document.getElementById('time');
	var height = 500;
	var step = 2;
	setInterval(function(){
		height -= step;
		time.style.height = height + 'px';

	if(height < 2 || height > 498)
		step *= -1;	

	}, 20);
}