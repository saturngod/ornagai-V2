<?php
// ၁။ ၂။ ျဖစ္ေနတာေတြ အတြက္။ ဘာျဖစ္လုိ႕လည္းဆိုေတာ့ ၁။ ၂။ တို႕က ျမန္မာစာ split လုပ္လုိက္တဲ့အခါ သီးသန္႕ ျဖစ္သြားတတ္တယ္။ ဥပမာ cat n ၁။ ေၾကာင္ဆုိရင္ cat n ၁ , cat n ေၾကာင္ ဆုိျပီး ျဖစ္သြားတတ္လို႕ပါ။
include('config.php');
connectdb();
$sql="SELECT *
FROM `dblist`
WHERE `def` LIKE '%၁။%'
UNION
SELECT *
FROM `dblist`
WHERE `def` LIKE '%၂။%'
UNION
SELECT *
FROM `dblist`
WHERE `def` LIKE '%၃။%'
";

$res=mysql_query($sql);
if(!$res)
{
	die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($res)) 
{
	$def=$row['def'];
	$def=str_replace("၁။ ","",$def);
	$def=str_replace("၁။","",$def);
	$def=str_replace("၂။ ","",$def);
	$def=str_replace("၂။","",$def);
	$def=str_replace("၃။ ","",$def);
	$def=str_replace("၃။","",$def);
	$def=str_replace("၄။ ","",$def);
	$def=str_replace("၄။","",$def);
	
	$result2=mysql_query("Update dblist set `def`=\"".$def."\" where `id`=".$row['id']);
	if (!$result2) {
		
		die('Invalid query: ' . "Update dblist set `def`='".$def."' where `id`=".$row['id']);
	}											
	
	echo "Working".$row['id']."\n";
}
echo "COMPLETE!!!";
?>
