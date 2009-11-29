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
        $join_date=date("d m y");
        $data = array(
               'username' => $username ,
               'salt' => $salt ,
               'password' => $pwd,
               'join_date' =>$join_date
            );

        $this->db->insert('user', $data); 
    }
}
?>