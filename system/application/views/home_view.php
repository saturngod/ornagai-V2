<?php
$data['base']=$base;
$this->load->view("header_view.php",$data);
?>
<script>
var form_id;
form_id=1;
$(document).ready(function(){
    $("#search").click(function(){
        
    
         $.ajax({
            type: "POST",
            url: "<?= $base ?>/index.php/search",
            data: "message="+$("#message").val(),
            success: function(html){
              $('body').append("<div id='form_"+form_id+"' class='ui-widget-content' style='z-index:"+form_id+"'><div class='ui-widget-header'>Result For "+$("#message").val()+"<span class='btn'><a class='mini' href='#'></a>&nbsp;<a ref="+form_id+" class='close' href='#'>&nbsp;</a></span></div>"+html+"</div>");
              
              
              
              return false;
            }
        });

    });

});
</script>
<body>
    
<div class="wrapper">
<img src="<?= $base ?>/images/logo.png" class="logo">
<form action="<?= $base ?>/index.php/search" method="post">
<input type="text" id="message" name="message" class="searchbox"><input type="button" value="Search" id="search">
</form>
</div>
</body>
</html>