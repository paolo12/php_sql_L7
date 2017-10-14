<?php
if (!empty($_GET)){
	if (empty($_GET['username'])){
		header('refresh: 7; url=list.php');
		echo '<br>'.'Имя не введено.';
		exit;
	}
	else if (empty($_GET['test'])){
		header('refresh: 7; url=list.php');
		echo '<br>'.'Файл с тестом не выбран.';
		exit;
	}
	else{
		if(!file_exists($_GET['test'].'.json')){
			header("HTTP/1.0 404 Not Found");
		}
		else{
			$json = file_get_contents($_GET['test'].'.json');
			$data = json_decode($json, true);
			
			echo '<p>Выполните тест:</p>'; 
			echo '<form method="post" action="test.php">';
			foreach($data as $element){
				echo '<p><b>'.$element['Question'].'</b></p>';
				foreach($element['Answers'] as $answer){
					echo '<p><input type="radio" name="'.$element['id'].'" value="a1">'.$answer['1'].'<br>';
					echo '<p><input type="radio" name="'.$element['id'].'" value="a2">'.$answer['2'].'<br>';
					echo '<p><input type="radio" name="'.$element['id'].'" value="a3">'.$answer['3'].'<br>';
				}
			}
			echo '<input type="hidden" name="username" id="username" value="'.$_GET['username'].'" />';
			echo '<p><input type="submit" value="Отправить ответы"></p>';
			echo '</form>';
		}

	}
}

else if(!empty($_POST)){
	$from_form = $_POST;
	$n = 0;

	foreach($from_form as $answer){
		if ($answer == "a2"){
			$n += 1;
		}
	}	
	
	$string = $_POST["username"].', ваше количество баллов: '.$n;
	$im     = imagecreatefrompng("certificate.png");
	$orange = imagecolorallocate($im, 220, 210, 60);
	$font = 'hermanomayor.ttf';
	imagettftext ($im, 16 , 0 , 130, 190 , $orange , $font , $string);
	header("Content-type: image/png; charset=utf-8");
	imagepng($im);
	imagedestroy($im);
}
else if(empty($_GET)){
	header('refresh: 7; url=list.php');
	echo '<br>'.'Выберите тест и введите имя пользователя!'.'<br>';
	exit;
}
 ?>