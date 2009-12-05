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
    
}
?>