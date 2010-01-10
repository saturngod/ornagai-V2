<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<div id="unapprove">
<?php
foreach ($query->result() as $row)
{
	echo $row->Word;
	echo "|";
	echo $row->state;
	echo "|";
	echo $row->def;
	echo "|";
	echo $row->username;
}
?>
</div>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>