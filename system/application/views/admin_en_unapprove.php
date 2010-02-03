<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<div id="unapprove">
<ul class="approve_list">
<?php
foreach ($query->result() as $row)
{
	
	echo "<li>";
	echo "<ul>";
	echo "<li>";
	echo "<input type=checkbox name='enword[]' value=".$row->word_id." />";
	echo "</li>";
	echo "<li>";
	echo $row->Word;
	echo "</li>";
	echo "<li>";
	echo $row->state;
	echo "</li>";
	echo "<li>";
	echo $row->def;
	echo "</li>";
	echo "<li>";
	echo $row->username;
	echo "</li>";
}
?>
</ul>
</div>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>