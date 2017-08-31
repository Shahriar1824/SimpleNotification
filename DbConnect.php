<?php
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
	$dbName = "livenotification";

	$dbConn = new MySqli($dbHost, $dbUser, $dbPass, $dbName);

	if ($dbConn->connect_errno){
        die("ERROR : -> ".$DBcon->connect_error);
    }
?>