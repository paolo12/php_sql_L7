<html>
<head>
<meta charset="utf-8">
<title>Test page</title>
<style>
    body {
        width: 75%;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>
<table border="1px" border-collapse="collapse" width="100%">
  <tr>
    <td align="center"><a href="admin.php"><span>Файл admin.php</span></a></td>
	<td align="center"><a href="list.php"><span>Файл list.php</span></a></td>
	<td align="center"><span>Файл test.php</span></td>
  </tr>
 </table>
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
		$json = file_get_contents($_GET['test'].'.json');
		$data = json_decode($json, true);
		$username = $_GET['username'];
		
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
		echo '<p><input type="submit" value="Отправить ответы"></p>';
		echo '</form>';
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
	header("Content-type: image/png");
	$string = $username.', поздравляем!'.'<br>'.'Вы набрали '.$n.'баллов!';
	$im     = imagecreatefrompng("certificate.png");
	$orange = imagecolorallocate($im, 220, 210, 60);
	$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
	imagestring($im, 3, $px, 190, $string, $orange);
	imagepng($im);
	imagedestroy($im);
}
else if(empty($_GET)){
	header('refresh: 7; url=list.php');
	echo '<br>'.'Выберите тест и введите имя пользователя!'.'<br>';
	exit;
}
 ?>
</body>
</html>