<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';

if(count($_POST) > 0){
	$a = $_POST['a'];
	$b = $_POST['b'];
	$operation = $_POST['operation'];
	
	switch($operation){
		case '+':
			$result = $a + $b;
			break;
		case '-':
			$result = $a - $b;
			break;
		case '*':
			$result = $a * $b;
			break;
		case '/':
			if($b != 0)
				$result = $a / $b;
				else
					echo 'Делить на 0 нельзя';
				break;
	}
}
else{
	$a='';
	$b='';
	$result = 0;
}	
?>
<html>
<head>
<title>88989898989</title>
</head>
	<body>
		<form method="post">
			<input type="text" name="a" value="<?php echo $a;?>"/>
			<select name="operation">
				<option value="+">+</option>
				<option value="-">-</option>
				<option value="*">*</option>
				<option value="/">/</option>
			</select>
			<input type="text" name="b" value="<?php echo $b;?>"/>
			<input type="submit" value="=" />
			<?php echo $result; ?>
		</form>
	</body>
</html>

