<?php
class User extends Controller {

	function User()
	{
		parent::Controller();	
	}
        
        function login()
        {
            $username=$_POST['name'];
            $pwd=$_POST['pwd'];
            $this->load->model("users");
            
            $result=$this->users->login($username,$pwd);
            if($result) echo "true";
            else            echo "false";
        }
	
	function logout()
	{
		$this->load->model("users");
		$this->users->logout();
		$this->load->helper('url');
		redirect('');
	}
}
?>