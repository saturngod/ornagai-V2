<?php

//Myanmar To English CSV
include('config.php');
connectdb();
$result=mysql_query("select `Word`,`state`,`def` from mydblist ORDER BY `Word`");
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

echo "Making Tab<br>";
$myFile = "tsv/mmtab.tsv";
$fh = fopen($myFile, 'w') or die("can't open file");


$myFile2 = "stardict/ornagaimm.tab";
$fh2 = fopen($myFile2, 'w') or die("can't open file");

while ($row = mysql_fetch_assoc($result)) 
{
	if(($row['Word']!="") and ($row['state']!="") and ($row['def']!=""))
	{

		$tmp=str_replace("|","",$row['def'])."	".$row['Word']."	".$row['state'];
		$tmp2=str_replace("|","",$row['def'])."	".$row['Word']."\\n".$row['state'];
		fwrite($fh,$tmp."\n");
		fwrite($fh2,$tmp2."\n");
	}
	echo "Working...".$row['Word']."\n";
}

fclose($fh);
fclose($fh2);
?>

