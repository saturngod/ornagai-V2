<?php
$data['title']=$title;
$data['base']=$base;
$this->load->view("touch_head",$data)
?>
<form id="ajax_search" action="<?= $base ?>/index.php/touch/search" method="POST" class="form">
    <div class="toolbar">
        <h1>Ornagai</h1>
    </div>
    <ul class="rounded">
        <li><input type="text" name="search" value="" placeholder="Search" /></li>
    </ul>
    <a style="margin:0 10px;color:rgba(0,0,0,.9)" id="search" href="#" class="submit whiteButton">Search</a>
    
    <h2>External Links</h2>
    <ul class="rounded">
        <li class="arrow"><a href="http://blog.ornagai.com" target="_blank">Ornagai Blog</a></li>
        <li class="arrow"><a href="http://github.com/saturngod/ornagai-V2" target="_blank">Sourcecode</a></li>
    </ul>
</form>
<?php
$this->load->view("touch_footer");
?>