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
</style>
<div id="register_wrapper">
<h2>Registration Completed.</h2>
<p>Thank you for register. Go to the <a href="<?= $base ?>">home page</a></p>
</div>