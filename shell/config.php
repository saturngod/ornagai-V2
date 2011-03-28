<?php
if(!isset($argv))
{
	echo "NEED SHELL ACCESS";
	exit();
}

$host="localhost:3306";

$usr="root";

$pwd="root";

$db="ornagai-test";

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

