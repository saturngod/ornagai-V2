<?php
class Word extends Model {
    
    function Word()
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

	$this->db->insert('mytable', $data);
	
	
	//Add Myanmar English Database
	
	$arr=preg_split("/။/",$def);
	
	foreach ($arr as $val)
	{
	    $val=trim(str_replace("(","",$val));
	    $val=trim(str_replace(")","",$val));
	    
	    if($val!="" and $val!=" ")
	    {
		$word_val=trim(str_replace("'","\'",$_POST['word']));
		$val=trim(str_replace("'","\'",$val));
		    
		 $this->load->model('zgnormalize','zgnor');
		$mya_def=$this->zgnor->zawgyi($val,"|",true);
	    }
	    
	}
	
       
        
	
	

    }
    
}
?>