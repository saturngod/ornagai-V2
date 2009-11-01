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
    echo $row->state;
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
?>