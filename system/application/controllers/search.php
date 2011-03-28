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
                $q=trim($_POST['message']);
		
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
		    		$q=$this->zawgyi->normalize($q,"|",true);
					$data['spelling']=false;
                }
				else
				{
					//specll check
					$this->load->library("spellcheck");
					$data['spelling']=$this->spellcheck->check($q);
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
					echo '<div id="res_list" class="result">';
					if($data['spelling'])
					{

						echo "<ul class='spell'>";
						echo "<li>Did you mean: </li>";
						foreach($data['spelling'] as $spell_word)
						{
							echo "<li><a class='spelling_check' href='#'>".$spell_word."</a></li>";
						}

						echo "</ul>";
					}
					echo "<br/><br/><br/>";
                    echo "Can't Find";
					echo "</div>";
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
		$num_row=$this->searchmodel->query_numrows($q,$myanmar);
		if($num_row>0)
		{
			foreach($query as $rows)
			{
				if($myanmar)
				{
					$def=$rows->def;
					$def=str_replace("|","",$def);
					echo $def."\n";
				}
				else
				{
					echo $rows->Word."\n";
				}
			}
		}
	}
}


?>