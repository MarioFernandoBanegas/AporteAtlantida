<?php

$serverName ="localhost";
 $usr="sa";
 $pwd="1234";
 $db="sv";

$connectionInfo = array("UID" => $usr, "PWD" => $pwd, "Database" => $db);

$conn = sqlsrv_connect($serverName, $connectionInfo);

 ?>
