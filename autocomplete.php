<?php
$word=$_GET['q'];

include('config.php');
include('normalize.php');
connectdb();


$myanmar_word="/[ကခဂဃငစဆဇဈဉညဋဌဍဎဏတထဒဓနပဖဗဘမယရလဝသဟဠအဣဤဥဦဧဩဪ၀၁၂၃၄၅၆၇၈၉၊။၌၍၎၏ေ]/";

if (preg_match($myanmar_word, $word ))
{
		$word=zawgyi_normalize($word,"|",true);
		
		$sql="
		SELECT * , IF( `def` = '$word', 1, IF( `def` LIKE '$word%', 2, IF( `def` LIKE '%$word', 4, 3 ) ) ) AS `sort`
FROM `mydblist`
WHERE `def` LIKE '%$word%'
ORDER BY `sort` , `def`
		
		";


		
		$mya=1;
		
	} else {
		$sql="
		SELECT * , IF( `Word` = '$word', 1, IF( `Word` LIKE '$word%', 2, IF( `Word` LIKE '%$word', 4, 3 ) ) ) AS `sort`
FROM `dblist`
WHERE `Word` LIKE '%$word%'
ORDER BY `sort` , `Word`
		
		";
		
		$mya=0;
	
	
	}
	
	$result=mysql_query($sql." LIMIT 0, 10");

	while ($row = mysql_fetch_assoc($result)) {
		
		if($mya==0)
		{
			echo $row['Word']."\n";
		}
		else
		{
			echo str_replace("|","",$row['def'])."\n";
		}
		
	}

	
	
	

?>
