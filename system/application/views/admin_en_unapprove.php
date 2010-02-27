<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<div id="unapprove">

<a href="#" id="approve">Approve</a>
<table border="0" cellpadding="0" cellspacing="0" class="table_admin">
<tr class="table_header">
<td>
<input type=checkbox id="chk_all" value='' />
</td>
<td>
Word
</td>
<td>
State
</td>
<td>
Defination
</td>
<td>
Username
</td>
</tr>
<?php
foreach ($query->result() as $row)
{
	echo "<tr>";
	echo "<td>";
	echo "<input class='enword' type=checkbox value=".$row->word_id." />";
	echo "</td>";
	echo "<td>";
	echo $row->Word;
	echo "</td>";
	echo "<td>";
	echo $row->state;
	echo "</td>";
	echo "<td>";
	echo $row->def;
	echo "</td>";
	echo "<td>";
	echo $row->username;
	echo "</td>";
	echo "</tr>";
}
?>
</table>
</div>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>