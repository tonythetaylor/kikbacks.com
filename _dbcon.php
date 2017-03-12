<?php

session_start();

$DB_host = "45.33.93.45";
$DB_user = "taylony";
$DB_pass = "*Q3-r0!_LnD";
$DB_name = "dblogin";

try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     /*** echo a message saying we have connected ***/
//     echo 'test database connection';
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once 'class.user.php';
//include 'class.user.php';
$user = new USER($DB_con);

?>
