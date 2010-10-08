<?php
class Voice extends Controller {

	function Voice()
	{
		parent::Controller();	
	}
	
	function index()
	{
	}
	function play()
	{
		$data['base']=$this->config->item('base_url');
		$data['sound']="http://translate.google.com/translate_tts?tl=en&q=".stripslashes($this->uri->segment(3));
		$data['sound']=urlencode($data['sound']);
		$data['mp3']=false;
		$this->load->library('user_agent');
		
		if ($this->agent->is_browser())
		{
		    /*if($this->agent->browser()=="Safari")
		    {
		    	$data['mp3']=true;
		    }
		    */
		}
		
		$this->load->view('voice.php',$data);
		
		
	}
}
?>