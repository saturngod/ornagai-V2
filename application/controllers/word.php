<?php
class Word extends CI_Controller {

        
        function add()
        {
        	if(isset($_POST['word']) && $_POST['word']!="")
        	{
				$word=$_POST['word'];
	            $state=$_POST['state'];
    	        $def=$_POST['def'];
        	    $this->load->model("words");
            	$this->words->add($word,$state,$def);
			    echo "true";        
			}
			echo "Error";
        }
}
?>