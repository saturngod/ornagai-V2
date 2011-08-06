<?php
class Register extends CI_Controller {

        
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
                    $this->load->model("users");
                    $this->users->save($_POST);
                    header("Location:".$this->config->item('base_url')."/index.php/register/thankyou");
                }
            }
                 
                $data['base']=$this->config->item('base_url');
                $data['title']="Ornagai :: Signup";
                $data['recaptcha']=$this->recaptcha->get_html();
                $this->load->library("recaptcha");
                $this->load->view("register_view",$data);    
        }
        
        function checkusr()
        {
            $usr=$_POST['name'];
            
            $this->load->model("users");
            $res=$this->users->check_exist($usr);
            
            if($res)
            {
                echo "true";
            }
            else{
                echo "false";
            }
        }
        
        function thankyou()
        {
            $data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: Thank You For Register";
            $this->load->view("thankyou_view",$data);
        }
        function forgotpwd()
        {
        	$email=$_POST['email'];
        	$this->load->model("users");
        	if($this->users->check_email($email))
        	{
        		$this->users->forget_send_mail($email);
        	}
        	else
        	{
  				echo "false";
        	}
        }
}
?>