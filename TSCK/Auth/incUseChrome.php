<?php
//load page using google chrome...................
if(stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome') == FALSE)
{
    echo "<center>";
    echo "<font face = \"verdana, tahoma\" size = \"2\">"; 
 	die("<a href = \"https://www.google.com/chrome/browser/desktop/\"> Click this link to install Google Chrome for optimized functionality</a>");
	
session_destroy();
}


//.............END.........

?>