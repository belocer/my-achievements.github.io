//Считаем колличесвто тегов <a> в документе
var myLinks = document.getElementsByTagName("a");
console.log("Links", myLinks.length);


//Меняю значение атрибута на свою ссылку
var mainContent = document.getElementById("mainContent");
mainContent.setAttribute("href","https://vk.com/id215715269");


//Меняю текст
var zag = document.getElementById("zag");
zag.innerHTML = "Site №1";


////////////Добавляю тег и содержимое/////////////////////////
//Для начала закидываю в переменные,- теги
var newHeading = document.createElement("h2") ;
var newParagraf = document.createElement("p") ;

//Затем в теже переменные докидываю контент
newHeading.innerHTML = "<a href='http://vk.cc/5roqQY' style='color: green; text-decoration: none; margin: auto;' target='_blank'>Менюшка</a><hr>";
newParagraf.innerHTML = "<b style='color: #949DB8;font-size: 24px;'>Рекламное сообщение или уникальное торговое предложение</b>";

//Добавляю ребенка
document.getElementById("zig").appendChild(newHeading);
document.getElementById("zig").appendChild(newParagraf);
//////////////////////////////////////////////////////////////

/*//Реакция на клик
var but = document.getElementById("but");
but.onclick = function () {
	var kar = document.getElementById("kar");
	kar.setAttribute("src","http://review-planet.ru/wp-content/uploads/2011/11/%D0%9C%D0%BE%D1%80%D0%B4%D0%B0.jpg");
	kar.setAttribute("style","width: 200px; height: 100px;");
}

//Реакция на клик
var but1 = document.getElementById("but1");
but1.onclick = function(){
	var karz = document.getElementById("kar");
	karz.setAttribute("src","http://lorempixel.com/output/city-q-c-200-100-4.jpg");*/
}


///////**********Реакция на заполнение поля**************//////
/*var emailField = document.getElementById("email");

emailField.onfocus = function(){
	if( emailField.value == 'email'){
		emailField.value = "";
	}
};

emailField.onblur = function(){
	if(emailField.value == ''){
		emailField.value = "email";
	}
};*/
///////****************************************//////

/////////////////////Авто слайдер//////////////////////
/*var myImage = document.getElementById("mainImage");
var imageArray = ['images/1.jpg',
				  'images/2.jpg',
				  'images/3.jpg',
				  'images/4.jpg',
				  'images/5.jpg',
				  'images/6.jpg',
				  'images/7.jpg',
				  'images/8.jpg',
				  'images/9.jpg',
				  'images/10.jpg',
				  'images/11.jpg'
				  ];
var imageIndex = 0;
function changeImage(){
	myImage.setAttribute( "src",imageArray[imageIndex] );
	imageIndex++;
	if ( imageIndex >= imageArray.length ){
		imageIndex = 0;
	}
}



////Остановка таймера

var stop = setInterval(changeImage,1000); 

myImage.onclick = function(){
	clearInterval(stop);//Очищаю интервал
}*/

///////////////////////////////////////////////////////////



//////////Проверка полей///////////
/*function prepareEventHandlers(){
	document.getElementById("frmContact").onsubmit = function(){
		if( document.getElementById("email").value == ""){
			document.getElementById("errorMessage").innerHTML = "<ul style='color: red;'><li>Введите email!</li></ul>";
			return false;
		}else{
			document.getElementById("errorMessage").innerHTML = "";
			return true;
		}
	};
}

window.onload = function (){
	prepareEventHandlers();
}*/
///
//////////////////////////////////////Реакция,- один чекбокс открывает многие///////////////
/*function preparePage(){
	document.getElementById("brochures").onclick = function(){
		if(document.getElementById("brochures").checked){
			document.getElementById("tourSelection").style.display = "block";
		}else{
			document.getElementById("tourSelection").style.display = "none";
		}
	};
	document.getElementById("tourSelection").style.display = "none";
}

window.onload = function(){
	preparePage();
}*/

//***********************************************************//


/////////////////Добавляю класс элементу по клику/////////////////
function preparePage(){
	document.getElementById("mc").onclick = function(){
		if(document.getElementById("mc").className == "example"){
			document.getElementById("mc").className = "";
		}else{
			document.getElementById("mc").className ="example";
		}
	};
}

window.onload = function (){
	preparePage();
}

//**********************************************************//


////////////////////////////////////////////
var currentPos = 0;
var intervalHandle;

function beginAnimate(){
	document.getElementById("join").style.position = "absolute";
	document.getElementById("join").style.left = "0px";
	document.getElementById("join").style.top ="100px";
	
	intervalHandle = setInterval(animateBox,50);
}

function animateBox(){
	currentPos+=5;
	document.getElementById("join")style.left = currentPos + "px";
	
	if(currentPos > 900) {
		clearInterval(intervalHandle);
		document.getElementById("join").style.position = "";
		document.getElementById("join").style.left = "";
		document.getElementById("join").style.top ="";
	}
}

window.onload = function(){
	setTimeout(beginAnimate,10000);
}










