<div id="edge">
    <div class="toolbar">
        <h1><?= $title ?></h1>
        <a href="#" class="back">Back</a>
    </div>
    <ul class="edgetoedge">
    	<?php
    	$output="";
    	$i=0;
    	foreach ($query  as $row)
    	{
    	$i=$i+1;
    	?>
    	<li class="sep"><?= $row->Word ?>( <?= $row->state ?> )</li>
    	<li><a style="font-family:Zawgyi-One" href="#more<?= $i ?>"><?= str_replace("|","",$row->def) ?></a></li>
    	<?php
    	$output.='<div id="more'.$i.'"><div style="font-size: 1.5em; text-align: center; margin: 160px 0 160px; font-family: Marker felt;">'.str_replace("|","",$row->def).'
    	    </div>
    	    <a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="whiteButton goback">Back</a>
    	</div>';
    	}
    	?>
    </ul>
</div>
<?php
echo $output;
?>