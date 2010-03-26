<?php

class Home extends Controller {

	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{
			$data['base']=$this->config->item('base_url');
			 
			$this->load->helper('url');
			$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
			$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		
			if ($iphone == true || $android==true)  {
				redirect("/touch/");
				exit();
			}
			
			
			if($_SERVER['HTTP_HOST']!="localhost")
            {
            	$portocol="http://";
            	/*if($_SERVER['HTTPS'] == on)
            	{
            		$portocol="https://";
            	}
            	*/
            	if($portocol.$_SERVER['HTTP_HOST']!=$data['base'])
            	{
            		
            		echo "Redirect";
            		$this->load->view("redirect_home",$data);

            	}
	
            }
            
            //Total En mm word
            $this->load->model("words");
            $data['entotal']=$this->words->get_en_total();
            $data['mmtotal']=$this->words->get_mm_total();
            
            
            
            $data['login']=$this->session->userdata('logged_in');              
			$this->load->view('home_view',$data);

	}
}

?>