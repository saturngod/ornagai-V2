<?php

include('config.php');
include("normalize.php");
connectdb();
mysql_query("TRUNCATE TABLE `mydblist`");
$query="select * from dblist";
$result=mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

	
$total=mysql_num_rows($result);

while ($row = mysql_fetch_assoc($result)) {
	$query="INSERT INTO `mydblist` (
	`id` ,
	`Word` ,
	`state` ,
	`def` ,
	`approve`
	)
	VALUES ";
	$def=$row['def'];
	$arr=preg_split("/။/",$def);
	foreach ($arr as $val)
	{
		

		$val=trim(str_replace("(","",$val));
		$val=trim(str_replace(")","",$val));
		if($val!="" and $val!=" ")
		{
			$word_val=trim(str_replace("'","\'",$row['Word']));
			//$val=zawgyi_normalize($val,"​",true);//zero width space
			$val=zawgyi_normalize($val,"|",true);					
			$val=trim(str_replace("'","\'",$val));
			$val2=substr($val,0,1);
			if($val2=="'") $val=substr($val,1);
	 		$query.="(NULL , '".$word_val."', '".$row['state']."','". $val."', '".$row['approve']."' ), ";

		}
	}

 $length = strlen($query);  
 $characters = 2;  
 $start = $length - $characters;
 $latest2word = substr($query , $start ,$characters);  

 
	if($latest2word==", ")
	{
	
		$query=substr($query, 0, -2);  
		
		echo "Work";
	
		$res=mysql_query($query);
		if (!$res) {
		die('Invalid query: ' . $query. "\n".mysql_error());		
		}
		
		echo "Row : ".$counter."complete \n";
	}
	$counter++;	




}

mysql_free_result($result);

?>
