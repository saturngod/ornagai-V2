<?php
$host="localhost";
$usr="root";
$pwd="root";
$db="dictionary2";
global $add_new;

$add_new=true;


function connectdb()
{
	global $host , $usr, $pwd,$db ;
	mysql_connect($host,$usr,$pwd);
	mysql_select_db($db);
	mysql_query("SET NAMES utf8");
}
?>
