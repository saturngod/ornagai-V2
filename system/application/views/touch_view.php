<?php
$data['title']=$title;
$data['base']=$base;
$data['theme']=$theme;
$this->load->view("touch_head",$data);
?>
<form id="search_frm">
	<div id="progress"><img src='<?= $base ?>/touch/images/search.gif'>&nbsp;Searching...</div>
    <div class="toolbar">
        <h1>Ornagai</h1>
    </div>
    <ul class="rounded">
        <li><input id="query" type="text" name="search" value="" placeholder="Search" /></li>
    </ul>
    <a style="margin:0 10px;color:rgba(0,0,0,.9)" id="search" href="#result" class="submit whiteButton">Search</a>
    
    <h2>External Links</h2>
    <ul class="rounded">
        <li class="arrow"><a href="http://blog.ornagai.com" target="_blank">Ornagai Blog</a></li>
        <li class="arrow"><a href="http://github.com/saturngod/ornagai-V2" target="_blank">Sourcecode</a></li>
    </ul>
  
    <script>
    $(function(){
    	$('#search').bind('tap', function() {
			search();
			return false;
    	});
    	$('#search_frm').submit(function(e)
    	{
    		search();
    		return false;
    	});
    });
    
    function search()
    {
    	//search
    	//url="<?= $base ?>/index.php/touch/search";
    	//alert($("#query").val());
    	$("#progress").fadeIn();
    	//$("#relist").html("<li class='sep'>hi</li>");
    	$.ajax({
    	  type: "POST",
    	  url:"<?= $base ?>/index.php/touch/search",
    	  data:"search="+$("#query").val(),
    	  success: function(html){
    	  	$("#relist").html(html);
    	  	$("#progress").fadeOut("fast");
    	  	jQT.goTo($('#result'), 'slide');
    	  },
    	  beforeSend: function() {
    	  	$("#progress").fadeIn("fast");
    	  }
    	 });
    	
    }
    </script>
    <style>
    /* progress loading */
    #progress { -webkit-border-radius: 10px; background-color: rgba(0,0,0,.7); color: white; font-size: 18px; font-weight: bold; height: 80px; left: 60px; line-height: 80px; margin: 0 auto; position: absolute; text-align: center; top: 120px; width: 200px;display: none;
    }
    </style>
</form>

<div id="result">
    <div class="toolbar">
        <h1><?= $title ?></h1>
        <a href="#" class="back">Back</a>
    </div>
    <ul id="relist" class="edgetoedge">
    
    
    </ul>    
    
</div>

<?php
$this->load->view("touch_footer");
?>