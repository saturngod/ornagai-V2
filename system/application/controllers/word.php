<?php
class Word extends Controller {

	function Word()
	{
		parent::Controller();	
        }
        
        function add()
        {
			$word=$_POST['word'];
            $state=$_POST['state'];
            $def=$_POST['def'];
            $this->load->model("words");
            $this->words->add($word,$state,$def);
		    echo "true";        
        }
}
?>