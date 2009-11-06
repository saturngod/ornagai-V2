<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("header_view",$data);
// Get a key from http://recaptcha.net/api/getkey
$publickey = "6Leg0QgAAAAAAG56ibAYPZ8K8BZhElJ5OyzwmkIL";
$privatekey = "6Leg0QgAAAAAAFTBTIwwQ9Rdp0Tdl0XmhUPU4RHg";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
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
    margin-bottom:8px;
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
</style>
<div id="register_wrapper">
<h2>Register</h2>
<label>User Name</label>
<input type="text" id="username">
<label>Password</label>
<input type="password" id="password">
<label>Confirm Password</label>
<input type="password" id="conf_password">
<label>Verify</label>
<? echo recaptcha_get_html($publickey, $error); ?>
<label></label>
<input type="submit" value="Register">
<input type="reset" value="Clear">
</div>
