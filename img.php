<?php

header("Content-type: image/png");
$string = ', поздравляем!'.'<br>'.'Вы набрали '.'баллов!';
$im     = imagecreatefrompng("certificate.png");
$orange = imagecolorallocate($im, 220, 210, 60);
$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
imagestring($im, 3, $px, 190, $string, $orange);
imagepng($im);
imagedestroy($im);

?>