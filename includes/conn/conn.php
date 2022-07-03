<?php

$serverName = "TIAGO-ALMEIDA\SQLEXPRESS"; 
$connectionInfo = array( "Database"=>"projeto", "UID"=>"sa", "PWD"=>"sa","CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !$conn ){ 
     echo "<h2 style=\"color:red;\">Connection error.</h2><br />";
}
