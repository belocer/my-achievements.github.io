/*АККАРДИОН*/

window.onload = function(){
$("#accordion").accordion();	
};

$(document).ready(function()
{


document.getElementById("myDiv").onclick = function(){
$("p").hide(2000);

document.getElementById("myDiv").style.border = "3px solid black";
document.getElementById("myDiv").style.height = "250px";
document.getElementById("myDiv").style.padding = "10px";
	
	
var newHeading = document.createElement("h2");
newHeading.innerHTML = "<img id='rock' style='width: 300px; height: 170px; border: 3px dotted black; border-radius: 30%;' src='http://worldversus.com/img/terminator.jpg'><span style='color: red; width: 300px; height: 170px; '>All be back! Кликни правой кнопкой мыши!</span>";
	
document.getElementById("myDiv").appendChild(newHeading);
	
}

	
document.getElementById("myDiv").oncontextmenu = function(){
	$("h2").hide(2000);
document.getElementById("myDiv").innerHTML =  "<img id='rock' style='width: 300px; height: 170px; border: 3px goover black; border-radius: 10%;' src='https://pp.vk.me/c627721/v627721087/9710/j1MD9lEKp68.jpg'>МОЛОДЕЦ!=)";
	
document.getElementById("myDiv").appendChild(news);	
$("#myDiv").hide(3000);
	
};
});