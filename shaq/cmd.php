<?php 
	exec('git clone -b php7 https://github.com/phpredis/phpredis.git',$output);
	print_r($output);
?>