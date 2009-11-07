<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("header_view",$data);

?>
<style>
/* Clear The Background Image */
body{
    background-image:none;
    background-color:#ccc;
}
#register_wrapper
{
    margin:0px auto;
    width:340px;
    border:1px solid #aaa;
    padding:10px;
    padding-top:2px;
    -moz-border-radius: 1em;  
    -webkit-border-radius: 1em;
    margin-top:10px;
    background-color:#fff;
}
#register_wrapper h2
{
    text-align:center;
}

#register_wrapper label
{
    display:block;
    margin-top:5px;
    margin-bottom:3px;
}

input[type=text],input[type=password]
{
    width:300px;
    height:30px;
    font-size:15px;
    background-color:#fff;
    border:1px solid #ccc;
     -moz-border-radius: 0em;  
    -webkit-border-radius: 0em;
    padding:2px;
}

input[type=text]:focus,input[type=password]:focus
{
    background-color:#D4DDE6;
    color:#0090E1;
    
}
#recaptcha_response_field
{
    height:20px;
}

.require
{
    color:red;
}

.verify
{
    margin-top: 4px;
    margin-left: 9px;
    position: absolute;
    width: 16px;
    height: 16px;
   
}
</style>
<div id="register_wrapper">
<h2>Register</h2>
<?= (isset($err) ? $err : ""); ?>
<form action="<?= $base?>/index.php/register" method="post">
    <label>User Name <span class="require">*</span></label>
    <input type="text" id="username" name="username"> 
    <label>Email <span class="require">*</span></label> 
    <input type="text" id="email" name="email"><span id="email_verify" class="verify"></span>
    <label>Password <span class="require">*</span></label>
    <input type="password" id="password" name="password"><span id="password_verify" class="verify"></span>
    <label>Confirm Password <span class="require">*</span></label>
    <input type="password" id="conf_password" name="conf_password"><span id="confrimpwd_verify" class="verify"></span>
    <label>Verify <span class="require">*</span></label>
    <span class="require"><?= form_error('recaptcha_response_field') ?></span>
    <? echo $recaptcha ?>
    <label></label>
    <input type="submit" value="Register">
    <input type="reset" value="Clear">
</form>
</div>
<!-- Jquery -->
<script>
$(document).ready(function(){
    
    //Check Email Verify
    $("#email").keyup(function(){
        var email = $("#email").val();
        
        if(email != 0)
        {
         
            if(isValidEmailAddress(email))
            {
               $("#email_verify").css({ "background-image": "url('<?= $base ?>/images/yes.png')" });
            } else {
               
                $("#email_verify").css({ "background-image": "url('<?= $base ?>/images/no.png')" }); 
            }
 
        }
        else {
            $("#email_verify").css({ "background-image": "none" });
        }

    });
    
    
    //Check Password Require
    $("#password").keyup(function(){
        
        if($("#conf_password").val()!="")
        {
            if($("#conf_password").val()!=$("#password").val())
            {
                $("#confrimpwd_verify").css({ "background-image": "url('<?= $base ?>/images/no.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?= $base ?>/images/no.png')" }); 
            }
            else{
                $("#confrimpwd_verify").css({ "background-image": "url('<?= $base ?>/images/yes.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?= $base ?>/images/yes.png')" }); 
            }
        }
    });
    
    $("#conf_password").keyup(function(){
        
        if($("#password").val()!="")
        {
            if($("#conf_password").val()!=$("#password").val())
            {
                $("#confrimpwd_verify").css({ "background-image": "url('<?= $base ?>/images/no.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?= $base ?>/images/no.png')" }); 
            }
            else{
                $("#confrimpwd_verify").css({ "background-image": "url('<?= $base ?>/images/yes.png')" }); 
                $("#password_verify").css({ "background-image": "url('<?= $base ?>/images/yes.png')" }); 
            }
        }
    });
    
});

function isValidEmailAddress(emailAddress) {
 		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
 		return pattern.test(emailAddress);
	}

</script>
