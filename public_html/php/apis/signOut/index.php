<?php

require_once "autoloader.php";
require_once "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

use Edu\Cnm\Crumbtrail; //why is it grayed out

/**
 * api for Sign Out of CrumbTrail
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/

//verify the session, start if not active.
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//Not for sure on this, i checked it out in the php documentation. but above we made sure that the session was started. here we are setting the session to an empty array in order to clear the values of the session.

//unsure if this is all i need or if there is more to this code. Dylan said only one line!! Check back after learning more about sessions.
$_SESSION = [];


//do i add the header and json encode down here? i dont think so.