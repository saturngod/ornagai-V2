<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("adminheader_view",$data);
?>
<link rel="stylesheet" href="<?= $base ?>/css/jq_style.css" type="text/css" />
<script src="<?= $base ?>/js/jq_box.js" type="text/javascript"></script>
<style>
label{
	display: block;
}
</style>
<script>
$(document).ready(function(){
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
});

function yesevent()
{

	$.ajax({
	    type: "POST",
	    url: "<?= $base ?>/index.php/admin/user_update",
	    data: "id="+$("#userid").val()+"&username="+$("#username").val()+"&email="+$("#email").val()+"&join_date="+$("#date").val()+"&ban="+$("#ban").attr("checked"),
	   	success: function(respond){
	   		$("#tr_"+$("#userid").val()).html("<td>"+$("#username").val()+"</td><td>"+$("#email").val()+"</td><td>"+$("#date").val()+"</td><td>"+$("#ban").attr("checked")+"</td>");
	   		$("#loading").fadeOut("fast");
	   	},
	   	beforeSend:function(){
	   		$("#loading").fadeIn("fast");
	   	}
	});
	
}

</script>
<?php
echo "<table width='100%'>";
echo "<tr>";
echo "<td>Username</td>";
echo "<td>Email</td>";
echo "<td>Join Date</td>";
echo "<td>Ban</td>";
echo "<td>Action</td>";
foreach ($userlist as $user)
{
    echo "<tr id='tr_{$user->id}'>";
    echo "<td>";
    echo $user->username;
    echo "</td>";
    echo "<td>";
    echo $user->email;
    echo "</td>";
    echo "<td>";
    echo $user->join_date;
    echo "</td>";
    echo "<td>";
    echo $user->ban;
    echo "</td>";
     echo "<td>";
    echo  "<a class='edit' href='{$base}/index.php/admin/usr_edit/{$user->id}' >Edit</a> | ";
    if($user->ban==0) echo  "<a href='{$base}/index.php/admin/usr_ban/{$user->id}' >Ban </a> | ";
    else echo "<a href='{$base}/index.php/admin/usr_ban/{$user->id}' >Unban </a> | ";
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