<?php

function fatorial($x)
{
	if($x == 1) return $x;
	return $x*fatorial($x-1);
}

for($i = 1; $i <=30; $i++)
{
	$f = fatorial($i);
	echo $i.' = '.$f.PHP_EOL;
}
?>
