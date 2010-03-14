<?php
sleep(5);
?>
<div id="edge">
    <div class="toolbar">
        <h1><?= $title ?></h1>
        <a href="#" class="back">Back</a>
    </div>
    <ul class="edgetoedge">
    	<?php
    	$output="";
    	foreach ($query  as $row)
    	{
    	?>
    	<li class="sep"><?= $row->Word ?>( <?= $row->state ?> )</li>
    	<li><a class="zg" href="#"><?= str_replace("|","",$row->def) ?></a></li>
    	<?php
    	}
    	?>
    	</ul>
    <style>
    .zg
    {
    	font-family: Zawgyi-one;
    }
    </style>
    <script type="text/javascript">
    			//load Zawgyi
    			Cufon.DOM.ready(function() {
        			Cufon.replace('.zg');
        		});
    </script>
</div>