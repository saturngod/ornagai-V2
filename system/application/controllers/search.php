<?php

class Search extends Controller {

	function Search()
	{
		parent::Controller();	
	}
	
	function index()
	{
            $data['base']=$this->config->item('base_url');
            if(isset($_POST['message']) and ($_POST['message']!=""))
            {
                $q=$_POST['message'];
                if(isset($_POST['page']))
                {
                    $page=$_POST['page'];
                }
                else
                {
                    $page=1;
                }
                $this->load->model('searchmodel');
                $myanmar=$this->searchmodel->detect_langauage($q);
        
                if($myanmar)
                {
		    $this->load->library("zawgyi");
		    $this->zawgyi->normalize($q,"|",true);
                }
                $data['query']=$this->searchmodel->query($q,$myanmar,$page);
                $data['result']=$q;
                $data['mm']=$myanmar;
               
                $data['num_rows']=$this->searchmodel->query_numrows($q,$myanmar);
                
                $data['numshow']=10;
                
                $data['page']=$page;
                if($data['query'])
                {
                    $this->load->view('result_view',$data);
                }
                else{
                    echo "Can't Find";
                }
                
                
            }
            else
            {
                //header("Location:".$this->config->item('base_url'));
		echo "Can't Find";
            }
	}
	
	function autocomplete()
	{
		parse_str($_SERVER['QUERY_STRING'],$_GET);
		$q=$_GET['q'];
		$this->load->model('searchmodel');
                $myanmar=$this->searchmodel->detect_langauage($q);
        
                if($myanmar)
                {
		    $this->load->library("zawgyi");
		    $this->zawgyi->normalize($q,"|",true);
                }
		$query=$this->searchmodel->query($q,$myanmar);
		foreach($query as $rows)
		{
			if($myanmar) echo $rows->def."\n";
			else			echo $rows->Word."\n";
		}
	}
}


?>