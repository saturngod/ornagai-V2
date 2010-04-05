<?php
class Users extends Model {
    
    function Users()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function check_exist($usr)
    {
        $this->db->where("username",$usr);
        $query=$this->db->get("user");
        if($query->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
        
        
    }
    
    function get_totalusr()
    {
        $query=$this->db->get("user");
        return $query->num_rows();
    }
    
    function getlist($start,$pershow)
    {
        $query=$this->db->get("user",$pershow,$start);
        return $query->result();
    }
    
    function logout()
    {
         $newdata = array(
                        'user_id'=>'',
                       'username'  =>'',
                       'email'     => '',
                       'logged_in' => FALSE,
                       'admin'=>''
                   );

        $this->session->unset_userdata($newdata );
    }
    function login($user,$pwd,$admin=false)
    {
        $this->db->where("username",$user);
        $query=$this->db->get("user");
        ////// get slat for password checking
         if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //get salt for passwod
                $salt=$rows->salt;
            }
            //////// Check Username and password ///////
             $password=sha1($salt.$pwd);
            
            $this->db->where("username",$user);
            $this->db->where("password",$password);
            if($admin) $this->db->where("admin","1");
            
            $query=$this->db->get("user");
            if($query->num_rows()>0)
            {
                 foreach($query->result() as $rows)
                 {
                    //add all data to session
                    $newdata = array(
                        'user_id'=>$rows->id,
                       'username'  => $rows->username,
                       'email'     => $rows->email,
                       'logged_in' => TRUE,
                       'admin'=>$rows->admin
                   );
                 }
                 $this->session->set_userdata($newdata);
                return true;
            }
        }
        return false;
    }
    
    //save user
    function save($data)
    {
        $username=$data['username'];
        $email=$data['email'];
        $salt=MD5(mt_rand(0,999));
        $pwd=sha1($salt.$data['password']);
        $join_date=date("Y-m-d");
        $data = array(
               'username' => $username ,
               'salt' => $salt ,
               'password' => $pwd,
               'email'=>$email,
               'join_date' =>$join_date
            );

        $this->db->insert('user', $data); 
    }
    
    function update($id,$data)
    {
    	$this->db->where('id', $id);
    	$this->db->update('user', $data); 
    }
    
    function del($id)
    { 		
    	$this->db->where_in("id",$id);
    	$this->db->delete('user');
    }
    	
    function ban($id)
    {
   		$this->db->where_in("id",$id);
    	$this->db->update("user",array("ban"=>1));    	
    }
    
    function unban($id)
    {
    	$this->db->where_in("id",$id);
    	$this->db->update("user",array("ban"=>0));
    
    }
    
    function check_email($email)
    {
    	$this->db->where("email",$email);
    	$query=$this->db->get("user");
    	if($query->num_rows()>0)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
    
    function changepwd($uid,$currpwd,$newpwd)
    {
    	$this->db->where("id",$uid);
    	$query=$this->db->get("user");
    	if($query->num_rows > 0)
    	{
    		$row = $query->first_row();
    		$salt=$row->salt;
    		$pwd=sha1($salt.$currpwd);
    		if($pwd==$row->password)
    		{
    			$pwd=sha1($salt.$newpwd);
    			$data = array(
               'password' => $pwd
            	);

				$this->db->where('id', $uid);
				$this->db->update('user', $data);
				return true;
    		}
    		else
    		{
    			return false;
    		}
    		//return $row->username;
    	}
    	else
    	{
    		return "false";
    	}
    	
    }
    
    function forget_send_mail($email)
    {
    	$username=$this->getnamebymail($email);
		

    	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To:'.$username.' <'.$email.'>'. "\r\n";
		$headers .= 'From: Ornagai <no-reply@ornagai.com>' . "\r\n";
		
		//Generate Text for new pwd
		$new_pwd=$this->generate_txt();
		$salt=MD5(mt_rand(0,999));
		$pwd=sha1($salt.$new_pwd);
		
		
		$data = array(
               'password' => $pwd,
               'salt' => $salt
            );

		$this->db->where('username', $username);
		$this->db->update('user', $data);
		
				
    	$message="Username : ".$username."</br>";
    	$message .= "Password : ".$new_pwd;
    	
    	mail($email, "Forgot password from Ornagai", $message, $headers);
    }
    
    function getnamebymail($email)
    {
    	$this->db->select('username');
    	$this->db->where("email",$email);
    	$query=$this->db->get("user");
    	
    	if($query->num_rows > 0)
    	{
    		$row = $query->first_row();
    		return $row->username;
    		
    	}
    }
    
    function generate_txt()
    {
    	$pwd=chr(rand(97,122));
    	$pwd.=chr(rand(65,90));
    	$pwd.=rand(0,9);
    	$pwd.=chr(rand(65,122));
    	$pwd.=rand(0,9);
    	return $pwd;
    	
    }
    
    /**
    * Get User information
    * @param integer $id
    * @return array $result
    */
    function info($id)
    {
		$this->db->where('id',$id);
		$query=$this->db->get("user");
		foreach($query->result() as $user)
		{
			$result=$user;
		}
		return $result;
    }
}
?>