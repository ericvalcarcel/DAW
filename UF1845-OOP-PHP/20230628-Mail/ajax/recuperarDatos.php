<?php
$myfile = fopen("../data/datos.txt", "r");
$html= fread($myfile,filesize("../data/datos.txt"));
fclose($myfile);
echo $html;
?>