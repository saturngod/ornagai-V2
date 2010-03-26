<?php
/*
* Starting Home Page of dictionary
* @author saturngod <saturngod@gmail.com>
* @version 2.0
* @package Ornagai
* @category Controller
* @todo need to check HTTPS
*/
class Home extends Controller {

	/*
	* Intalize Home Page
	*/
	function Home()
	{
		parent::Controller();	
	}
	
	/*
	* Index page call home_view View
	*/
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