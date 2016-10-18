<?php

function fibonacci($num)
{
   if($num==1 || $num==2)
       return 1;
   else
       return fibonacci($num-1) + fibonacci($num-2) . '-';
}

$n = rand(1,20);
echo fibonacci(6);

?>