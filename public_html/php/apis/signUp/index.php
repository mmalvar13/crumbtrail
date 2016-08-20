<?php

require_once "autoloader.php";//where is this? same autoload.php as before or a new one?
require_once "/lib/xsrf.php"; //when do we make this?
require_once("/etc/apache2/crumbtrail-mysql/encrypted-config.php"); //do i put crumbtrail-mysql here?

use Edu\Cnm\Crumbtrail; //is this correct? i dont have to add mmalvar13 right?

/**
 * api for signUp
 *
 * @author Monica Alvarez <mmalvar13@gmail.com>
 **/

//verify the session, start if not active