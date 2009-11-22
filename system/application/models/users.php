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
    
    function login($user,$pwd)
    {
        
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