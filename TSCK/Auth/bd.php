<?php
switch(strpos($_SERVER['HTTP_USER_AGENT'], $browser) !== FALSE) {
case $browser='MSIE':
	echo 'Internet explorer...';
		
case $browser='Firefox':
	echo 'Mozilla Firefox...';
	
case $browser='Chrome';
	echo 'Google Chrome...';	
	
default:
	echo 'Something else...';
}
?>