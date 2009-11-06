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
    width:500px;
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
</style>
<div id="register_wrapper">
<h2>Register</h2>
<?= (isset($err) ? $err : ""); ?>
<form action="<?= $base?>/index.php/register" method="post">
<label>User Name</label>
<input type="text" id="username" name="username">
<label>Email</label>
<input type="text" id="email" name="email">
<label>Password</label>
<input type="password" id="password" name="password">
<label>Confirm Password</label>
<input type="password" id="conf_password" name="conf_password">
<label>Verify</label>
<?= form_error('recaptcha_response_field') ?>
<? echo $recaptcha ?>
<label></label>
<input type="submit" value="Register">
<input type="reset" value="Clear">
</form>
</div>
