<?php

//Myanmar To English CSV
include('config.php');
connectdb();
date_default_timezone_set('Asia/Singapore');
$result=mysql_query("select `Word`,`state`,`def` from dblist ORDER BY `Word`");
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

echo "Making Tab<br>";
$myFile = "tsv/entab.tsv";
$fh = fopen($myFile, 'w') or die("can't open file");


$myFile2 = "stardict/ornagaien.tab";
$fh2 = fopen($myFile2, 'w') or die("can't open file");

while ($row = mysql_fetch_assoc($result)) 
{
	if(($row['Word']!="") and ($row['def']!=""))
	{

		$tmp=trim($row['Word'])."	".$row['state']."	".trim($row['def']);
		$tmp2=trim($row['Word'])."	".$row['state']."\\n".trim($row['def']);
		fwrite($fh,$tmp."\n");
		fwrite($fh2,$tmp2."\n");
	}
	echo "Working...".$row['Word']."\n";
}

fclose($fh);
fclose($fh2);
/*echo shell_exec("zip -r entsv.zip entab.tsv");
echo shell_exec("zip -r stardict.zip stardict.tab");
*/
?>

