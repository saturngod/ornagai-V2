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
