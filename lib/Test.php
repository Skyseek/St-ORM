<?php

use Sky\St;
use Sky\St\ORM as StORM;

require_once 'Sky/St/ORM.php';


$userStatus = new UserStatus();
$query = St\ORM::eql("SELECT FROM User WHERE UserStatus=?", $userStatus);
echo $query;


class UserStatus
{
	public $id;
}

