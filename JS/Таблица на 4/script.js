jQuery('document').ready(function(){
	var score = 0;
	var answer = '';
	
	answer = prompt("4*3");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="12"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}
	
	answer = prompt("4*1");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="4"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}

	answer = prompt("4*5");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="20"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}
	
	answer = prompt("4*7");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="28"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}
	
	answer = prompt("4*9");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="36"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}
	
	answer = prompt("4*10");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="40"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}

	answer = prompt("4*2");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="8"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}
	
	answer = prompt("4*6");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="24"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}

	answer = prompt("4*8");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="32"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}
	
	answer = prompt("4*4");
	if (isNaN(answer)){
		alert("Ай-яй-яй, надо вводить только числа")
	}
	if(answer=="16"){
		alert("молодец давай дальше");
		score = score + 1;
	}else{
		alert("Повторить надо бы :|");
	}	
	alert("Правильных ответов: " + score);
	alert("Я тебя люблю");

});
