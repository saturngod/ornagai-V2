<?php

include('config.php');
connectdb();

date_default_timezone_set('Asia/Singapore');

function json_write($start,$stop,$end_word="")
{
	if($end_word=="")
	{
		$sql="SELECT SQL_NO_CACHE `Word`,`state`,`def` from dblist order by `Word`";
	}
	else
	{
		$sql="SELECT SQL_NO_CACHE `Word`,`state`,`def` from dblist where `Word` > '".$end_word."' order by `Word`";
	}
	$result=mysql_query($sql);
	
	
	if (!$result) {
	    die('Invalid query: ' . mysql_error());
	}
	for($i=$start;$i<=$stop;$i++)
	{
		${$i} = fopen("data/".$i.".json", 'w') or die("can't open file");
		$json='{"data":[';
		fwrite(${$i},$json);
		if($i==$stop) break;
		
	}
	
	while ($row = mysql_fetch_assoc($result)) 
	{
		
		if(($row['Word']!="") and ($row['state']!="") and ($row['def']!=""))
		{
			$two_start=strtolower(substr($row['Word'],0,2));
			
			//{"word":"awaking","state":"v[ing]","def":"နိုးေန"},
			if(isset(${$two_start}))
			{
				$data='{"word":"'.trim($row['Word']).'","state":"'.trim($row['state']).'","def":"'.trim($row['def']).'"},';
				fwrite(${$two_start}, $data);

			}
		}
	}
	
	for($i=$start;$i<=$stop;$i++)
	{
		$json="\n]}";
		fwrite(${$i},$json);
		fclose(${$i});
		
		if($i==$stop) break;
		
		unset(${$i});
	}
}

json_write("aa","jq","");
json_write("jr","tc","joys");
json_write("td","zz","taxpayers");

echo "\nCOMPLETE!!!";
?>
