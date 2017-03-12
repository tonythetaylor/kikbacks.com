<?php

session_start();

$DB_host = "";
$DB_user = "";
$DB_pass = "";
$DB_name = "";

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
