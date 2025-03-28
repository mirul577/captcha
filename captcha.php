<?php
session_start();

// Generate a random CAPTCHA string
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789'; // Avoid confusing chars
$captcha_text = '';
for ($i = 0; $i < 5; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}

// Store it in session for later verification
$_SESSION['captcha'] = $captcha_text;

// Create the image
$width = 150;
$height = 50;
$image = imagecreatetruecolor($width, $height);

// Define colors
$bg_color = imagecolorallocate($image, 255, 255, 255);     // white
$text_color = imagecolorallocate($image, 0, 0, 0);         // black
$line_color = imagecolorallocate($image, 100, 100, 100);   // gray

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Add random lines for obfuscation
for ($i = 0; $i < 6; $i++) {
    imageline($image, rand(0, $width), rand(0, $height),
                     rand(0, $width), rand(0, $height), $line_color);
}

// Add the CAPTCHA text
$font_size = 5; // Built-in font size (1–5)
$text_width = imagefontwidth($font_size) * strlen($captcha_text);
$text_height = imagefontheight($font_size);
$x = ($width - $text_width) / 2;
$y = ($height - $text_height) / 2;

imagestring($image, $font_size, $x, $y, $captcha_text, $text_color);

// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
