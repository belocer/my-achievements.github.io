// Отправляем ajax -ом jquery
/*
function statq(stat, th){
	var stat = stat;
	var th = th;
	var param = {
	
	statphp: stat,	
	th: th,	
		
	}; 
	
	$.post("php/status_select.php", param, function (data){
		
		document.getElementById('hop').innerHTML = data;
		$("hop").html(data);
	});
		
}; */

// Отправляем ajax -ом ванила
function statq(st, th){
								alert(1); //тест №777
	var request = new XMLHttpRequest();
	var url = 'php/status_select.php?stat='+st+'&th='+th;
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			document.querySelector('#hop').innerHTML = request.responseText;
		}
	}
	request.open('GET', url);
	request.setRequestHeader('Content-Type', 'application/x-www-form-url');
	request.send();
}

	
	
	
	
	
	
	
	
	
	
	
	
	

