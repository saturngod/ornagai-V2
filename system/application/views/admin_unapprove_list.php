<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<script>
<?
$this->load->view("jquery_start");
?>

$("#chk_all").click(function(){
	$('.enword').attr("checked", $(this).attr("checked"));
});
$("#approve").click(function(){
	$("#loading").fadeIn("fast");
	var tr_id=0;
	var index=0;
	var tr_id_list = new Array();
	var $chkbox_list= new Array();
	
	//Collect checkbox checked list
	$('.enword:checked').each(function() {
		index=index+1;
    	tr_id=tr_id+","+$(this).val();
    	
    	tr_id_list[index]=$(this).val();
    	$chkbox_list[index]=$(this);
    });

	//Approve word
	$.ajax({
    		  url: '<?= $base ?>/index.php/admin/<?= $controller_approve ?>',
    		  type: "POST",
    		  data: "id="+tr_id,
    		  success: function(data) {
        		for(i=1;i<=index+1;i++)
        		{
        			//uncheck for refresh
        			$chkbox_list[i].attr("checked",false);
        			$("#row_"+tr_id_list[i]).fadeOut("fast");
        			$("#loading").fadeOut("fast");
        		}
    		  }
    });
    
    return false;
    		
});

$("#remove").click(function(){
	$("#loading").fadeIn("fast");
	var tr_id=0;
	var index=0;
	var tr_id_list = new Array();
	var $chkbox_list= new Array();
	
	//Collect checkbox checked list
	$('.enword:checked').each(function() {
		index=index+1;
    	tr_id=tr_id+","+$(this).val();
    	
    	tr_id_list[index]=$(this).val();
    	$chkbox_list[index]=$(this);
    });

	//Remove word
	$.ajax({
    		  url: '<?= $base ?>/index.php/admin/<?= $controller_remove ?>',
    		  type: "POST",
    		  data: "id="+tr_id,
    		  success: function(data) {
        		for(i=1;i<=index+1;i++)
        		{
        			//uncheck for refresh
        			$chkbox_list[i].attr("checked",false);
        			$("#row_"+tr_id_list[i]).fadeOut("fast");
        			$("#row_"+tr_id_list[i]).remove();
        			$("#loading").fadeOut("fast");
        		}
    		  }
    });
    
    return false;
    		
});


<?php
$this->load->view("jquery_end");
?>
</script>
<div id="unapprove">

<div class="btnbar">
	<input type="button" id="approve" value="Approve" />
	<input type="button" id="remove" value="Remove" />
</div>
<table border="0" cellpadding="0" cellspacing="0" class="table_admin" width="100%">
	<tr class="table_header">
		<th style="text-align:left">
			<input type="checkbox" id="chk_all" value='' />
		</th>
		<th>
			Word
		</th>
		<th>
			State
		</th>
		<th>
			Defination
		</th>
		<th>
			Username
		</th>
		<th>
			Action
		</th>
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
	echo "<td>";
	echo "<a class='approve' href='{$base}/index.php/admin/{$controller_approve}/{$row->word_id}'>Approve</a>";
	echo " | ";
	echo "<a class='remove' href='{$base}/index.php/admin/{$controller_remove}/{$row->word_id}'>Remove</a>";
	echo " | ";
	echo "<a href='#'>Edit</a>";
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