<?php
class Word extends Controller {

	function Word()
	{
        }
        
        function add()
        {
            $word=$_POST['word'];
            $state=$_POST['state'];
            $def=$_POST['def'];
            $this->load->model('word');
            $this->word->add($word,$state,$def);
            
        }
}
?>