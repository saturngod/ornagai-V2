<?php

class Home extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
			$data['base']=$this->config->item('base_url');
			  
			if($_SERVER['HTTP_HOST']!="localhost")
            {
            	$portocol="http://";
            	if($_SERVER['HTTPS'] == on)
            	{
            		$portocol="https://";
            	}
            	if($portocol.$_SERVER['HTTP_HOST']!=$data['base'])
            	{
            		
            		echo "RedirectÉ";
            		$this->load->view("redirect_home",$data);

            	}
	
            }
            $data['login']=$this->session->userdata('logged_in');              
			$this->load->view('home_view',$data);

	}
}

?>