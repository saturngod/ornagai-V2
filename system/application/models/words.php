<?php
class Words extends Model {
    
    function Words()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function add($word,$state,$def)
    {
        
        $this->load->library('session');
        
        $data = array(
               'Word' => $word ,
               'state' => $state ,
               'def' => $def,
               'approve' => 0,
               'usr_id' =>$this->session->userdata('user_id')
            );

		$this->db->insert('dblist', $data);
	
	
		//Add Myanmar English Database
	
		$arr=preg_split("/။/",$def);
	
		foreach ($arr as $val)
		{
	    	$val=trim(str_replace("(","",$val));
	    	$val=trim(str_replace(")","",$val));
	    
	    	if($val!="" and $val!=" ")
	    	{		    
				$this->load->library("zawgyi");
				$mya_def=$this->zawgyi->normalize($val,"|",true);
		 		$mya_def="|".$mya_def;
				$data = array(
		   			'Word' => $word ,
		   			'state' => $state ,
		   			'def' => $mya_def,
		   			'approve' => 0,
		   			'usr_id' =>$this->session->userdata('user_id')
		     	);

				$this->db->insert('mydblist', $data);
	    	}
		}
    }
    
    function get_my_unapprove()
    {
    	$this->db->where("approve",0);
    	$result=$this->db->get("mydblist");
    	return $result;
    }
    
    function en_approve($id)
    {	
    	$data = array('approve' => 1);
    	$id=spliti(',',$id);
    	$this->db->where_in("id",$id);
    	$this->db->update('dblist',$data);	
    	
    }
    
    function my_approve($id)
    {	
    	$data = array('approve' => 1);
    	$id=spliti(',',$id);
    	$this->db->where_in("id",$id);
    	$this->db->update('mydblist',$data);	
    	
    }
    
    
    function get_unapprove_total()
    {
    	$this->db->where("approve",0);
    	$query=$this->db->get("dblist");
    	return $query->num_rows;
    }

    function get_my_unapprove_total()
    {
    	$this->db->where("approve",0);
    	$query=$this->db->get("mydblist");
    	return $query->num_rows;
    }

    function get_enunapprove_list($start,$pershow)
    {
    	$this->db->select('dblist.id as word_id,Word,state,def,approve,usr_id,username');
		$this->db->from('dblist');
    	$this->db->join('user', 'dblist.usr_id=user.id');
    	$this->db->where("approve",0);
    	$query=$this->db->get("",$pershow,$start);
        return $query->result();
    }
    
    function get_myunapprove_list($start,$pershow)
    {
    	$this->db->select('mydblist.id as word_id,Word,state,def,approve,usr_id,username');
    	$this->db->from('mydblist');
    	$this->db->join('user', 'mydblist.usr_id=user.id');
    	$this->db->where("approve",0);
    	$query=$this->db->get("",$pershow,$start);
        return $query->result();
    }
    
    function get_en_total()
    {
    	$query=$this->db->get("dblist");
    	return $query->num_rows;
    }
    
    function get_mm_total()
    {
    	$query=$this->db->get("mydblist");
    	return $query->num_rows;
    }
}
?>