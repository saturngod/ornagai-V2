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
<script type="text/javascript">
			//load Zawgyi
			Cufon.DOM.ready(function() {
    			Cufon.replace('.zg');
    		});
</script>
<style>
.zg
{
	font-family: Zawgyi-one;
}
ul li a, li.img a + a {
	white-space: normal !important;
}
ul li a.zg
{
	background: none !important;
	
	<?php
	if($theme=='iphone')
	{
		echo "color: #000";
	}
	else
	{
		echo "color: #FFF";
	}
	?>
	
	
}
</style>
