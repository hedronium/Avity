<?php

$x = 8;
$y = 8;
// Load the image
$img = imagecreatefrompng("some.png"); // or imagecreatefromjpeg(), etc.

// Set a colour for the sides of the rectangle
$color = imagecolorallocate($img, 255, 255, 255); // for a white rectangle

// Draw an 8x8 recangle at coordinates ($x, $y) from top left
imagerectangle($img, $x, $y, $x+8, $y+8, $color);

// Or, use imagefilledrectangle() with the same arguments if you want it filled

// Save the image
imagepng($img, "some.png"); // or imagejpeg(), etc.
?>
