<?php

$serverName ="A01DINFA4725\SQLEXPRESS";
 $usr="";
 $pwd="";
 $db="sv";

$connectionInfo = array("UID" => $usr, "PWD" => $pwd, "Database" => $db);

$conn = sqlsrv_connect($serverName, $connectionInfo);

 ?>
