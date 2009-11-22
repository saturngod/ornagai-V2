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
            $this->model->load("users");
            
            $result=$this->users->login($username,$pwd);
            if($result) echo "true";
            else            echo "false";
        }
}
?>