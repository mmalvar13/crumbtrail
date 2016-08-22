<?php
/**
 * api for Sign Out of CrumbTrail
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/

//verify the session, start if not active.
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

// here we are setting the session to an empty array in order to clear the values of the session.
$_SESSION = [];
