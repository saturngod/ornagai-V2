(function($){  
 $.fn.jqbox = function(options) {  
  
   var defaults = {  
   html: "",
   width:200,
   height:200,
   alertbox:false,
   confirmbox:false,
   onyes:"",
   onno:"",
   onok:"",
   yestxt: "YES",
   notxt:"NO",
   oktxt: "OK",
   closebtn:true
    
  };  
    
  var options = $.extend(defaults, options);  
      
  return this.each(function() { 
  
  		$(".jqbox_innerhtml").remove();
		$(".jqbox_shadow").remove();
		  	 
  		margin_top=(options.height/2)+50;
  		margin_left=(options.width/2)
  		
  		
  		$("body").append("<div class='jqbox_shadow'></div>");
  		$("body").append("<div class='jqbox_innerhtml'><div class='jqbox_html_data'>"+options.html+"</div></div>");
  		if(options.closebtn)
  		{
  			$(".jqbox_innerhtml").append("<img src='../../images/fancy_closebox.png' class='jqbox_close'>");
  		}
  		
  		if(options.alertbox)
  		{
  			$(".jqbox_innerhtml").append("<div class='jqbox_bottom'><div class='jqbox_ok jqbox_btn'>"+options.oktxt+"</div></div>");
  		}
  		else if(options.confirmbox)
  		{
  			$(".jqbox_innerhtml").append("<div class='jqbox_bottom'><div class='jqbox_yes jqbox_btn'>"+options.yestxt+"</div><div class='jqbox_no jqbox_btn'>"+options.notxt+"</div></div>");
  		}
  		
  		
  		
  		
  		$(".jqbox_innerhtml").css("width",options.width+"px");
  		$(".jqbox_innerhtml").css("height",options.height+"px");
  		$(".jqbox_innerhtml").css("margin-top","-"+margin_top+"px");
  		$(".jqbox_innerhtml").css("margin-left","-"+margin_left+"px");
  		
  		$(".jqbox_shadow").fadeIn();
  		$(".jqbox_innerhtml").fadeIn("slow");
  		
  		if(options.closebtn)
  		{
  			$(".jqbox_close").click(function(){
				$(".jqbox_innerhtml").fadeOut("slow");
			  	$(".jqbox_shadow").fadeOut("slow");
			  	
  			});
  		}
  		
  		$(".jqbox_ok").click(function(){
  			$(".jqbox_innerhtml").fadeOut("slow");
		  	$(".jqbox_shadow").fadeOut("slow");
		  	
		  	if(options.onok!="") eval(options.onok);
		  	
  		});
  		
  		$(".jqbox_yes").click(function(){
  			$(".jqbox_innerhtml").fadeOut("slow");
		  	$(".jqbox_shadow").fadeOut("slow");
		  	if(options.onyes!="")	eval(options.onyes);
  		});
  		
  		
  		$(".jqbox_no").click(function(){
  			$(".jqbox_innerhtml").fadeOut("slow");
		  	$(".jqbox_shadow").fadeOut("slow");
		  	if(options.onno!="") eval(options.onno);
  		});

  		
  		
    });  
   
 };  
})(jQuery); 