
window.onload = function(){
	var btn = document.getElementById('btnRun');

	//document.getElementById('inpy').onkeyup = function(){ Это живой калькулятор
	//document.getElementById('inpx').onkeyup = function(){ Это живой калькулятор
	btn.onclick = function(){
		var x = parseInt(document.getElementById('inpx').value);
		var y = parseInt(document.getElementById('inpy').value);
		var r = x + y;
		document.getElementById('spnResult').innerHTML= r;
	}
}