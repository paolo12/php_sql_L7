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
<p>Ваш результат:</p>
<?php
if (empty($_POST)){
	header('refresh: 7; url=admin.php');
	echo 'Тест не выполнен!';
	exit;
}
$from_form = $_POST;
$n = 0;

foreach($from_form as $answer){
	if ($answer == "a2"){
		$n += 1;
	}
}
$img = imagecreatetruecolor(640, 480);
$file_ttf = __DIR__.'/HermanoMayor.ttf';
$grey = imagecolorallocate($img, 128, 128, 128);
$img_cert = imagecreatefrompng(__DIR__.'/certificate.png');
$cert_text = $_POST['username'];

imagecopy($img, $img_cert, 0, 0, 20, 13, 80, 40);
imagettftext($img, 20, 0, 11, 21, $grey, $file_ttf, $cert_text);

header('Content-type: image/png');
imagepng($img);
imagedestroy($img);

echo 'У вас правильных ответов: '.$n.'<br>';
?>
</body>
</html>