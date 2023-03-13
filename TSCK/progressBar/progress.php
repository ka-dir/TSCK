<?php

if (strlen(session_id()) === 0) {
    //session_start();
}
makeProgress();

function makeProgress() 
{
    $progress = 0;
    $max = 100;
    for ($i = 1; $i <= $max; $i++) 
	{
        if (isset($_SESSION['progress']))
		{
            session_start(); //IMPORTANT!
        }
        $progress++;
        $_SESSION['progress'] = $progress;
        session_write_close(); //IMPORTANT!
        sleep(1); //IMPORTANT!
    }
}
   
   


if (strlen(session_id()) === 0) {
    session_start();
}

if (isset($_SESSION['progress'])) {
    echo $_SESSION['progress'];
    if ($_SESSION['progress'] == 100) {
        unset($_SESSION['progress']);
    }
} else {
    echo '0';
}   

 
   ?>
   

