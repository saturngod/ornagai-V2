<?php
header("Content-type:charset=utf-8");
$eff_row=0;
include('config.php');
connectdb();

$sql="
CREATE TABLE `tmptable` (
`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`Word` VARCHAR( 100 ) NOT NULL ,
`state` VARCHAR( 10 ) NOT NULL ,
`def` TEXT NOT NULL ,
`approve` VARCHAR( 1 ) NOT NULL DEFAULT '0' ,
INDEX ( `Word` )
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;

";

$result=mysql_query($sql);

if(!$result)
{
	  echo "Could not successfully run query ($sql) from DB: " . mysql_error();
      exit;
}


$sql="Select * from dblist";

$result=mysql_query($sql);

if(!$result)
{
	  echo "Could not successfully run query ($sql) from DB: " . mysql_error();
      exit;
}

if (mysql_num_rows($result) == 0)
{
	echo "Error No Record";
	exit;
}
else
{
	while ($row = mysql_fetch_assoc($result)) {
		
		$row['Word']=str_replace("'","\'",$row['Word']);
		$row['state']=str_replace("'","\'",$row['state']);
		$row['def']=str_replace("'","\'",$row['def']);
		
		$sql2="select * from `tmptable` where Word='".$row['Word']."' And state='".$row['state']."'";
		$res=mysql_query($sql2);
		
		if(!$res)
		{
		  echo "Could not successfully run query ($sql2) from DB: " . mysql_error();
    	  exit;
		}

		if (mysql_num_rows($res) == 0)
		{
			$sql3="Insert Into `tmptable`(
				`id`,
				`Word`,
				`state`,
				`def`,
				`approve`)
			Values( NULL,";
			$sql3.="'".$row['Word']."','".$row['state']."','".str_replace("​","",$row['def'])."','".$row['approve']."');";
			
		}
		else
		{
			if(substr($res['def'],-1)=='။')
			{
				$def=$res['def'];
			}
			else
			{
				$def=$res['def']." ။ ";
			}
			$sql3="
			UPDATE `tmptable` SET `def` = '".$def.$row['def']."' WHERE `Word` ='".$row['Word']."' And `state` ='".$row['state']."'";
			
			$eff_row=$eff_row+1;

		}
		
		$res=mysql_query($sql3);
		if(!$res)
		{
		  echo "Could not successfully run query ($sql3) from DB: " . mysql_error();
    	  exit;
		}
		else
		{
		
			echo "OK....".$row['Word']."\n";

		}
		
		
		
	}
}

mysql_query("Drop Table `dblist`");
mysql_query("Alter Table `tmptable` RENAME `dblist`");
echo "Totoal Effect Row : ".$eff_row;
?>