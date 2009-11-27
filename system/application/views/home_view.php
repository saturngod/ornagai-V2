<?php
$data['base']=$base;
$this->load->view("header_view.php",$data);
$this->load->helper('form');
?>
<script>
var h_id;
var history_flag;
history_flag=1;
h_id=1;
$(document).ready(function(){
    $("#login_form").hide();
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
    ////////////
    
    $("#login_btn").live("click", function(){
        if($("#login_form").is(":hidden")) {
            $("#login_form").slideDown("fast");
            $("#wrapper").css("margin-top","0px");
        }
        else{
            $("#login_form").slideUp("fast");
            $("#wrapper").css("margin-top","40px");
        }

    });
    ////////////
    
    $("#login").live("click",function(){
    
        username=$("#username").val();
        password=$("#pwd").val();
         $.ajax({
            type: "POST",
            url: "<?= $base ?>/index.php/user/login",
            data: "name="+username+"&pwd="+password,
            success: function(html){
               
              if(html=='true')
              {
                $(".popup").fadeOut("fast");
                $("#login_form").remove();
                $("#wrapper").css("margin-top","40px");
              }
              else
              {
                    $(".popup").fadeOut("fast");
                    $("#err_msg").html("Wrong username or password")
              }
            },
            beforeSend:function(){
                $(".popup").fadeIn("fast");
            }
        });
         return false;
    });
    
     $("#cancel").live("click", function(){
      
            $("#login_form").slideUp("fast");
            $("#wrapper").css("margin-top","40px");

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
            data: "message="+$(this).attr("rel")+"&page="+$(this).html(),
            success: function(html){
              $("#result").html(html);
            },
            beforeSend:function(){
                $("#result").html("Loading...")
            }
        });
    });
    
    $("#username").focus(function(){
        if($(this).val()=="Username")
        {
            $(this).css({"color":"#333"});
            $(this).val("");
           
        }
    });
    
    $("#txtpwd").focus(function(){
       $(this).hide();
       $("#pwd").show();
       $("#pwd").focus();
    })
    
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
    <div class="popup"><p><br/><br/><br/><br/><img src="<?= $base ?>/images/load.gif"></p></div>
    <div id="login_form" class="login_frm">
    <?= form_open("user/login"); ?>
    <input type="text" value="Username" id="username" >
    <input type="text" value="Password" id="txtpwd">
    <input type="password" id="pwd" style="display:none" >
    <input type="submit" value="Login" id="login">
    <input type="button" value="Cancel" id="cancel">
    <span class="err" id="err_msg"></span>
    <?= form_close(); ?>
    </div>
    <?= form_open("search/result"); ?>
    <div class="top_menu">
        <img src="<?= $base ?>/images/logo.png" class="logo" width=32px">
        <input type="text" id="message" name="message" class="searchbox">
        <input type="submit" value="Search" id="search">
        <img src="./images/history.png" id="history_onoff" class="select_btn btn">
            <img src="./images/history.png" id="login_btn" class="btn">
    </div>
<?= form_close(); ?>
    <div id="wrapper">
        <div id="left">
            <h3>History</h3>
        </div>
        <div id="result"></div>
        <div class="history_result"></div>
    </div>
</body>
</html>