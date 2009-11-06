<?php
class Register extends Controller {

	function Register()
	{
		parent::Controller();	
	}
        
        function index()
        {
            $data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: Signup";
            $this->load->library("recaptcha");
            $this->load->view("register_view",$data);
        }
}
?>