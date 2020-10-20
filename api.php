<?php
require_once('toolkit.php');
require_once('database.php');
Runtime::start();
Utils::checkData();
RetVal::positive(["message"=>"received"]);