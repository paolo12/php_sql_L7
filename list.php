<?php
if (empty($_FILES['userfile']['tmp_name'])){
	header('refresh: 7; url=admin.php');
	echo 'Файл не загружен!';
	exit;
}

$json = file_get_contents($_FILES['userfile']['tmp_name']);
$data = json_decode($json, true);
?>
<html>
<head>
<meta charset="utf-8">
<title>List page</title>
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
	<td align="center"><span>Файл list.php</span></td>
	<td align="center"><a href="test.php"><span>Файл test.php</span></a></td>
  </tr>
 </table>
<p>Выполните тест:</p>
 <form method="post" action="test.php">
 <?php foreach($data as $element){ ?>
  <p><b><?php echo $element['Question'] ?></b></p>
  <?php foreach($element['Answers'] as $answer){ ?>
  <p><input type="radio" name="<?php echo $element['id'] ?>" value="a1"><?php echo $answer['1'].'<br>'; ?>
  <input type="radio" name="<?php echo $element['id'] ?>" value="a2"><?php echo $answer['2'].'<br>'; ?>
  <input type="radio" name="<?php echo $element['id'] ?>" value="a3"><?php echo $answer['3']; ?></p>
  	<?php	
			}
		}
	?>
  <p><input placeholder="Ваше имя" name="username"></p>
  <p><input type="submit" value="Отправить ответы"></p>
 </form>
</table>
</body>
</html>