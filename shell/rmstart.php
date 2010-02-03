<?php
// ။ ေတြ ေနာက္မွာ space ပါတာေတြ ရွင္းထုတ္တာ
include('config.php');
connectdb();
$sql="SELECT *
FROM `dblist`
WHERE `def` LIKE ' ။%'
UNION
SELECT *
FROM `dblist`
WHERE `def` LIKE '။%'
";

$res=mysql_query($sql);
if(!$res)
{
	die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($res)) 
{

	$def=$row['def'];

	if(substr($def,0,5)==" ။ ")
	{
		$def=substr($def,5,strlen($def));
		echo $def;
	}
	elseif(substr($def,0,4)=="။ ")
	{
		$def=substr($def,4,strlen($def));
		echo $def;
	}

	$result2=mysql_query("Update dblist set `def`=\"".$def."\" where `id`=".$row['id']);
	if (!$result2) {
		
		die('Invalid query: ' . "Update dblist set `def`='".$def."' where `id`=".$row['id']);
	}											
	
	echo "Working".$row['id']."\n";

}
echo "COMPLETE!!!";
?>
