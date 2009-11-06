<?php
class Register extends Controller {

	function Register()
	{
		parent::Controller();	
	}
        
        function index()
        {
            $this->load->library('recaptcha');
            $this->load->library('form_validation');
            $this->lang->load('recaptcha');
            $this->load->helper('form');
            $this->form_validation->set_rules('recaptcha_response_field','lang:recaptcha_field_name','required|callback_check_captcha'); 
       
            if(isset($_POST['username']))
            {
            
                if ($this->form_validation->run()) 
                {
                    header("Location:".$this->config->item('base_url')."/index.php");
                }
            }
                 
                $data['base']=$this->config->item('base_url');
                $data['title']="Ornagai :: Signup";
                $data['recaptcha']=$this->recaptcha->get_html();
                $this->load->library("recaptcha");
                $this->load->view("register_view",$data);
            
            
        }
}
?>