<?php
$data['base']=$base;
$this->load->view("header_view.php",$data);
?>
<script>
var h_id;
var history_flag;
history_flag=1;
h_id=1;
$(document).ready(function(){
    $("#search").click(function(){
        
    if($("#message").val()!="")
    {
         $.ajax({
            type: "POST",
            url: "<?= $base ?>/index.php/search",
            data: "message="+$("#message").val(),
            success: function(html){
              $("#result").html(html);
              $("#left").append('<div id="history_'+h_id+'" class="history"><a rel="'+$("#message").val()+'" href="#" class="history_result">'+$("#message").val()+'<img rel="history_'+h_id+'" src="./images/remove.png" align="middle" class="sidebar_rm" align="right" /></a></div>');
               
                h_id=h_id+1;
            },
            beforeSend:function(){
                $("#result").html("Loading...")
            }
        });
     }
        return false;
    });
    

    $(".sidebar_rm").live("click", function() {
    
        frmdiv_id=$(this).attr("rel");
      //  alert(frmdiv_id);
        $("#"+frmdiv_id).fadeOut("fast");
        return false;
    });
    
    $(".page_nav").live("click",function()
    {
       
        $.ajax({
            type: "POST",
            url: "<?= $base ?>/index.php/search",
            data: "message="+$(this).attr("href")+"&page="+$(this).html(),
            success: function(html){
              $("#result").html(html);
            },
            beforeSend:function(){
                $("#result").html("Loading...")
            }
        });
        return false;
    });
    
   $(".history").live("mouseover", function() {
    form_id=this.id;
    $("#"+form_id+" .sidebar_rm").css({"visibility":"visible"});
    
   });
   
    $(".history").live("mouseout", function() {
    form_id=this.id;
    $("#"+form_id+" .sidebar_rm").css({"visibility":"hidden"});
    
   });
    
    $("#history_onoff").click(function()
    {
       if(history_flag==1)
       {
     
        $("#history_onoff").removeClass("select_btn");
        $("#left").hide();
        $("body").css({"background-image":"none"});
        history_flag=0;
      
       }
       
       else{
        $("#history_onoff").addClass("select_btn");
        $("#left").show();
         $("body").css({"background-image":"url('./images/bg.jpg')"});
        history_flag=1;
       }
    })
   $(".history_result").live("click", function() {

                if($(this).attr("rel")!="")
                {
                    $.ajax({
            type: "POST",
            url: "<?= $base ?>/index.php/search",
            data: "message="+$(this).attr("rel"),
            success: function(html){
              $("#result").html(html);
               
                h_id=h_id+1;
            },
            beforeSend:function(){
                $("#result").html("Loading...")
            }
        });
                }
    });
});
</script>
<body>
    <div class="login_frm">
    <input type="text" name="username" value="username">
    <input type="password" name="password" value="password">
    </div>
    <div class="top_menu">
        <img src="<?= $base ?>/images/logo.png" class="logo" width=32px">
        <input type="text" id="message" name="message" class="searchbox">
        <input type="button" value="Search" id="search">
        <img src="./images/history.png" id="history_onoff" class="select_btn btn">
    </div>

    <div id="wrapper">
        <div id="left">
            <h3>History</h3>
        </div>
        <div id="result"></div>
        <div class="history_result"></div>
    </div>
</body>
</html>