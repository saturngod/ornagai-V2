<?php

require(APPPATH.'/libraries/REST_Controller.php');

class api extends REST_Controller
{
	function word_get()
	{
		if(!$this->get('q'))
		{
			$this->response(NULL, 400);
			exit;
		}
		$q=$this->get("q");
		
		$this->load->model('searchmodel');
		$myanmar=$this->searchmodel->detect_langauage($q);
		
		if(!$this->get('page'))
		{
			$page=1;
		}
		else
		{
			$page=$this->get('page');
		}
		
        if($myanmar)
        {
		    $this->load->library("zawgyi");
		    $q=$this->zawgyi->normalize($q,"|",true);
        }
        $query=$this->searchmodel->query($q,$myanmar,$page);
        
      
      		if($this->get('count'))
      		{
        		$num_rows[0]=array("count"=>$this->searchmodel->query_numrows($q,$myanmar));
        	}
        	
        	
        	//exit;
     
        
        
       $i=0;
       	foreach($query as $row)
       	{
       		$return[$i]['word']=$row->Word;
       		$return[$i]['state']=$row->state;
       		if(!$myanmar)
       		{
       			$return[$i]['def']=str_replace("|","",$row->def);
       		}
       		else
       		{
       			$return[$i]['def']=$row->def;
       		}
       		$i++;
       	}
       	
       	if(isset($num_rows))
       	{
       		$this->response($num_rows,200);
       	}
       	else if(isset($return))
       	{
       		$this->response($return, 200); // 200 being the HTTP response code
       		
       	}
       	else
       	{
       	    $this->response(array('error' => 'word could not be found'), 404);
       	}
       	
	}
}
?>