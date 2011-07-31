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
    background-color:#97C6EE;
    color:#FFF;
    
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

.err
{
  
    text-align:center;
    padding:5px;
    background-color:#FFAAAA;
    border:1px dashed #DD0000;
}
</style>
<div id="register_wrapper">
<?php echo (isset($err) ? "<div class='err'>".$err."</div>" : ""); ?>
<form action="<?php echo $base?>/index.php/admin/login" method="post">
    <label>User Name </label>
    <input type="text" id="username" name="username">
    <label>Password </label>
    <input type="password" id="password" name="password"></span>
    <label></label>
    <input id="register" type="submit" value="Login">
    <input type="reset" value="Clear">
</form>
</div>