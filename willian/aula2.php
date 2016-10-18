<?php

function fibArray($num){
   if($num==1 || $num==2) return 1;
   else return fibArray($num-1) + fibArray($num-2);
}

function media($a){	
	echo array_sum($a)/sizeof($a).PHP_EOL;
}

function cubo($n){
	return $n*$n*$n;
}


// fibonacci
$n = rand(1,10);
$fibonacci = [];

for($i = 1 ; $i <= $n ; $i++){
	$fibonacci []= fibArray($i);
}

echo implode(',', $fibonacci).PHP_EOL;
// end fibonacci


// media
$a = [1,2,3,4,5];
media($a);
// end media


// cubo
$c = array_map('cubo', $a);
echo implode(',', $c);
// end cubo

?>