<?php

foreach ($query  as $row)
{
    echo $row->Word;
    echo "<br>";
    echo $row->state;
    echo "<br>";
    echo str_replace("|","",$row->def);
    echo "<div class='seprator'></div>";
}
?>