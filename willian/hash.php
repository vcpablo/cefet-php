<?php
$texto = 'Willian';
echo str_pad('CRC32:',9, ' ');
echo crc32($texto), PHP_EOL;
echo str_pad('MD5:',6), md5($texto), PHP_EOL;
echo str_pad('SHA1:',6), sha1($texto), PHP_EOL;

?>