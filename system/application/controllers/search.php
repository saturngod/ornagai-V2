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
                    $this->load->model('zgnormalize','zgnor');
                    $q=$this->zgnor->zawgyi($q,"|",true);
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
                header("Location:".$this->config->item('base_url'));
            }
	}
}


?>