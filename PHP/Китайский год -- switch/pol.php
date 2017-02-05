<!doctype html>
<html>
<head>
<title></title>
</head>
<body>

<?php 
$a = 5;
    
    switch ($a){
        case 0:
            echo "а равно 0<br>";
            break;
        case 1:
            echo "а равно 1<br>";
            break;
        case 2:
            echo "а равно 2<br>";
            break;
        case 3:
            echo "а равно 3<br>";
            break;
        default:
            echo "а не равно не 1 не 2 не 3-м!<br>";
    }
?>
        
<?php
    $year =2015;
    switch(($year - 4) % 12){
        case  0: $zodiac = 'Крысы';     break;
        case  1: $zodiac = 'Быка';      break;
        case  2: $zodiac = 'Тигра';     break;
        case  3: $zodiac = 'Кроллика';  break;
        case  4: $zodiac = 'Дракона';   break;
        case  5: $zodiac = 'Змеи';      break;
        case  6: $zodiac = 'Лошади';    break;
        case  7: $zodiac = 'Козла';     break;
        case  8: $zodiac = 'Обезьяны';  break;
        case  9: $zodiac = 'Петуха';    break;
        case 10: $zodiac = 'Собаки';    break;
        case 11: $zodiac = 'Свиньи';    break;
    }
    echo "{$year} год - {$zodiac}.";
    ?>
			
</body>
</html>