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
	var tr_id=0;
	var index=0;
	var tr_id_list = new Array();
	var $chkbox_list= new Array();
	
	//Collect checkbox checked list
	$('.enword:checked').each(function(index) {
		index=index+1;
    	tr_id=tr_id+","+$(this).val();
    	
    	tr_id_list[index]=$(this).val();
    	$chkbox_list[index]=$(this);
    });

	//Approve word
	$.ajax({
    		  url: '<?= $base ?>/index.php/admin/<?= $controller ?>',
    		  type: "POST",
    		  data: "id="+tr_id,
    		  success: function(data) {
        		for(i=1;i<=index+1;i++)
        		{
        			//uncheck for refresh
        			$chkbox_list[i].attr("checked",false);
        			$("#row_"+tr_id_list[i]).fadeOut("fast");
        		}
    		  }
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
foreach ($wordlist as $row)
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
<?php echo $paging; ?>
</div>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>