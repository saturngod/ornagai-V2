<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<script>
<?
$this->load->view("jquery_start");
?>

$("#approve").click(function(){
	$('.enword:checked').each(function(index) {
    	tr_id=$(this).val();
    	$check=$(this);
    	$.ajax({
    		  url: '<?= $base ?>/index.php/admin/enapprove',
    		  type: "POST",
    		  data: "enid="+tr_id,
    		  success: function(data) {
        	
        		$check.attr("checked",false);
    			$("#row_"+tr_id).fadeOut("fast");
    		  }
    		});
    	
    	//$("#row_"+tr_id).remove();

  });

});

<?php
$this->load->view("jquery_end");
?>
</script>
<div id="unapprove">

<a href="#" id="approve">Approve</a>
<table border="0" cellpadding="0" cellspacing="0" class="table_admin">
<tr class="table_header">
<td>
<input type="checkbox" id="chk_all" value='' />
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
	echo "<tr id='row_".$row->word_id."'>";
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