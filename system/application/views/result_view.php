<div class="result">
<?php
foreach ($query  as $row)
{
    echo "<div class='result'>";
    if(!$mm)
    {
        echo str_replace($result,"<font color='#0090E1'>".$result."</font>",$row->Word);   
    }
    else{
        echo $row->Word;
    }
    echo "<br>";
    echo "<b><font color='#7082AA'>".$row->state."</font></b>";
    echo "<br>";
    if(!$mm)
    {
        echo str_replace("|","",$row->def);
    }
    else{
        $result=str_replace("|","",$result);
         echo str_replace($result,"<font color='#0090E1'>".$result."</font>", str_replace("|","",$row->def));
    }
    echo "</div>";
}


$start=floor($page/$numshow);
$end=$start+10; // 10 is show number of page nav in current page

$tot_page=ceil($num_rows/$numshow);
$start_mod=$page % $numshow;
if($start_mod==0) $start=$start-1;
$start=$start * $numshow;
if($start==0) $start=1;

?>
<div class="page_lnk">
<?
for($i=$start;$i<=$end;$i++)
{
	if($i>$tot_page) break;
	
	if($i==$page)
	{
		echo "<b>$i</b>&nbsp;";
	}
	else
	{
		echo "<a href='$result' class='page_nav'>$i</a>&nbsp;";
	}
}
?>
</div>