window.onload = function(){
	
	
	$('#thumbs').delegate('img','click', function(){
		$('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
		$('#description').html($(this).attr('alt'));
	});
	
	
	
}

	
	
