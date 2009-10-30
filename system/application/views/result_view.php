<?php

foreach ($query  as $row)
{
    echo "<p>";
    echo $row->Word;
    echo "<br>";
    echo $row->state;
    echo "<br>";
    echo str_replace("|","",$row->def);
    echo "</p>";
}
?>