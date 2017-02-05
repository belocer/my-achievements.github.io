$('#search').keyup(function() {
	var searchField = $('#search').val();
	var myExp = new RegExp(searchField, "i");
	$.getJSON('answer.json', function(data) {
		var output = '<ul class="searchresults">';
		$.each(data, function(key, val) {
			if ((val.tags.search(myExp) != -1) ||
			(val.name_product.search(myExp) != -1)) {
				output += '<li>';
				output += '<h2>'+ val.name_product +'</h2>';
				output += '<div class="block1"><img src="'+ val.path_file1 +'" alt="'+ val.name_product +'" /></div>';
				output += '<div class="block2"><p class="descript">'+ val.description +'</p></div>';			
				output += '<div class="block3"><iframe src="'+val.video+'" frameborder="0" allowfullscreen></iframe></div>';
				//output += '<div class="block4"><a href="'+ val.page +'" target="_blank">Ссылка на сайт</a></div>';
				output += '</li>';
			};
		});
		output += '</ul>';
		$('#update').html(output);
	}); //get JSON
});

function come(){
	
var name = document.getElementById('name').value;	
var email = document.getElementById('email').value;	
var comment = document.getElementById('comment').value;	

	var param = {
		
		name: name,
		email: email,
		comment: comment,
		
	};
	
	$.post("search.php", param, function (data) {

	    document.getElementById('res_comment').innerHTML = data;

	});
	
};


function del_id(){
	
	var id = document.getElementById('dDiv').value;
	
	var param = {		
		id: id,		
	};
	
	$.post("del.php", param, function (data) {

	    document.getElementById('res_coment').innerHTML = data;

	});
};


function logout(){
	
	var logout = logout;
	var param = {		
		logout: logout,		
	};
	
	$.post("logout.php", param, function (data) {

	});
};