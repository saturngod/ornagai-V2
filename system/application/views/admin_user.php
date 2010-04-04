<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<style>
label{
	display: block;
}
</style>
<script>
$(document).ready(function(){

	//User Delete From Link
	$(".delete").click(function(){
		var id=$(this).attr("rel");
		$.ajax({
		    type: "POST",
		    url: $(this).attr("href"),
		    success: function(html){
		       $("#loading").fadeOut("fast");
		       $("#tr_"+id).fadeOut();
		       $("#tr_"+id).remove();
		    },
		    beforeSend:function(){
		        $("#loading").fadeIn("fast");
		    }
		});
		 return false;
	});
	
	//User Edit From Link
	$(".edit").click(function(){
		
		$.ajax({
		    type: "POST",
		    url: $(this).attr("href"),
		    success: function(respond){
		      $("#loading").fadeOut("fast");
		      $().jqbox({
		      html:respond,
		      width:500,
		      height:200,
		      confirmbox:true,
		      onyes:"yesevent()",
		      yestxt: "Save",
		      notxt:"Cancel"
		      });
		      
		      
		    },
		    beforeSend:function(){
		        $("#loading").fadeIn("fast");
		    }
		});
				
				return false;
	});
	
	//Ban User From List
	$(".ban").live("click",function(){
		id=$(this).attr("rel");
		$.ajax({
		    type: "POST",
		    url: $(this).attr("href"),
		    success: function(respond){
		    	$("#spban_"+id).html("<a class='unban' rel='"+id+"' href='<?= $base ?>/index.php/admin/usr_unban/"+id+"' >Unban </a> | ");
		      	$("#loading").fadeOut("fast");
		    },
		    beforeSend:function(){
		        $("#loading").fadeIn("fast");
		    }
		});
				
				return false;
	});
	
	//Unban User From List
	//Ban User From List
	$(".unban").live("click",function(){
		id=$(this).attr("rel");
		
		$.ajax({
		    type: "POST",
		    url: $(this).attr("href"),
		    success: function(respond){
		   		$("#spban_"+id).html("<a class='ban' rel='"+id+"' href='<?= $base ?>/index.php/admin/usr_ban/"+id+"' >Ban </a> | ");
		    	$("#loading").fadeOut("fast"); 
		      
		    },
		    beforeSend:function(){
		        $("#loading").fadeIn("fast");
		    }
		});
				
				return false;
	});
	
	// Delete User List get from checkbox
	$("#delete").click(function(){
		
		$("#loading").fadeIn("fast");
		var tr_id=0;
		var index=0;
		var tr_id_list = new Array();
		var $chkbox_list= new Array();
		
		//Collect checkbox checked list
		$('.usrchk:checked').each(function() {
			index=index+1;
			tr_id=tr_id+","+$(this).val();
			
			tr_id_list[index]=$(this).val();
			$chkbox_list[index]=$(this);
			
		});
	
		//Delete User
		$.ajax({
				  url: '<?= $base ?>/index.php/admin/usr_del',
				  type: "POST",
				  data: "id="+tr_id,
				  success: function(data) {
		    		for(i=1;i<=index+1;i++)
		    		{
		    			//uncheck for refresh
		    			
		    			$chkbox_list[i].attr("checked",false);
		    			$("#tr_"+tr_id_list[i]).fadeOut("fast");
		    			$("#tr_"+tr_id_list[i]).remove();
		    			$("#loading").fadeOut("fast");
		    		}
				  }
		});
		
		return false;
		
	});
	
	
	// Ban User List get from checkbox
	$("#ban").click(function(){
		
		$("#loading").fadeIn("fast");
		var tr_id=0;
		var index=0;
		var tr_id_list = new Array();
		var $chkbox_list= new Array();
		
		//Collect checkbox checked list
		$('.usrchk:checked').each(function() {
			index=index+1;
			tr_id=tr_id+","+$(this).val();
			
			tr_id_list[index]=$(this).val();
			$chkbox_list[index]=$(this);
			
		});
		
		//Ban User
		$.ajax({
				  url: '<?= $base ?>/index.php/admin/usr_ban',
				  type: "POST",
				  data: "id="+tr_id,
				  success: function(data) {
		    		for(i=1;i<=index+1;i++)
		    		{
		    			//uncheck for refresh
		    			
		    			$chkbox_list[i].attr("checked",false);
		    			id=tr_id_list[i];

		    			$("#spban_"+id).html("<a class='unban' rel='"+id+"' href='<?= $base ?>/index.php/admin/usr_unban/"+id+"' >Unban </a> | ");
		    			
		    			$("#loading").fadeOut("fast");
		    		}
				  }
		});
		
		return false;
		
	});
	
	// UnBan User List get from checkbox
	$("#unban").click(function(){
		
		$("#loading").fadeIn("fast");
		var tr_id=0;
		var index=0;
		var tr_id_list = new Array();
		var $chkbox_list= new Array();
		
		//Collect checkbox checked list
		$('.usrchk:checked').each(function() {
			index=index+1;
			tr_id=tr_id+","+$(this).val();
			
			tr_id_list[index]=$(this).val();
			$chkbox_list[index]=$(this);
			
		});
		
		//Ban User
		$.ajax({
				  url: '<?= $base ?>/index.php/admin/usr_unban',
				  type: "POST",
				  data: "id="+tr_id,
				  success: function(data) {
		    		for(i=1;i<=index+1;i++)
		    		{
		    			//uncheck for refresh
		    			
		    			$chkbox_list[i].attr("checked",false);
		    			id=tr_id_list[i];

		    			$("#spban_"+id).html("<a class='ban' rel='"+id+"' href='<?= $base ?>/index.php/admin/usr_ban/"+id+"' >Ban </a> | ");
		    			
		    			$("#loading").fadeOut("fast");
		    		}
				  }
		});
		
		return false;
		
	});
	
});

function yesevent()
{

	$.ajax({
	    type: "POST",
	    url: "<?= $base ?>/index.php/admin/user_update",
	    data: "id="+$("#userid").val()+"&username="+$("#username").val()+"&email="+$("#email").val()+"&join_date="+$("#date").val()+"&ban="+$("#ban").attr("checked"),
	   	success: function(respond){
	   		//Change update
	   		$("#tdusr_"+$("#userid").val()).html($("#username").val());
	   		$("#tdmail_"+$("#userid").val()).html($("#email").val());
	   		$("#tddate_"+$("#userid").val()).html($("#date").val());
	   		
	   		ban="NO";
	   		if($("#ban").attr("checked")==true)
	   		{
	   			ban="YES";
	   		}
	   		
	   		
	   		$("#loading").fadeOut("fast");
	   	},
	   	beforeSend:function(){
	   		$("#loading").fadeIn("fast");
	   	}
	});
	
}

</script>
<div class="btnbar">
	<input type="button" id="delete" value="Delete" />
	<input type="button" id="ban" value="Ban" />
	<input type="button" id="unban" value="Unban" />
</div>
<table border="0" cellpadding="0" cellspacing="0" class="table_admin" width="100%">
	<tr class="table_header">
		<td><input type="checkbox" id="chk_all" /></td>
		<td>Username</td>
		<td>Email</td>
		<td>Join Date</td>
		<td>Action</td>
	</tr>
<?php
foreach ($userlist as $user)
{
    echo "<tr id='tr_{$user->id}'>";
    echo "<td><input class='usrchk' type='checkbox' value={$user->id} /></td>";
    echo "<td id='tdusr_{$user->id}'>";
    echo $user->username;
    echo "</td>";
    echo "<td id='tdmail_{$user->id}'>";
    echo $user->email;
    echo "</td>";
    echo "<td id='tddate_{$user->id}'>";
    echo $user->join_date;
    echo "</td>";
    echo "</td>";
    echo "<td>";
    echo "<a class='edit' href='{$base}/index.php/admin/usr_edit/{$user->id}' >Edit</a> | ";
    echo " <span id='spban_{$user->id}'>"; 
    if($user->ban==0) echo  "<a class='ban' rel='{$user->id}' href='{$base}/index.php/admin/usr_ban/{$user->id}' >Ban </a> | ";
    else echo "<a rel='{$user->id}' class='unban' href='{$base}/index.php/admin/usr_unban/{$user->id}' >Unban </a> | ";
    echo "</span>";
    echo  "<a class='delete' rel='{$user->id}' href='{$base}/index.php/admin/usr_del/{$user->id}' >Delete</a>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

echo $paging;
?>
<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminfooter_view",$data);
?>