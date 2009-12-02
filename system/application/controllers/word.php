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
            echo $word;
        }
}
?>