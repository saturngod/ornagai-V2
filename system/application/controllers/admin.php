<?php
class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
                   $this->load->helper('url');
                   
                   if($this->uri->segment(2)!='login')
                   {
                        if(!(($this->session->userdata('logged_in')) && ($this->session->userdata('admin')==1)))
                        {
                                 redirect("/admin/login");
                        
                        }
                   }
	}
        
        function index()
        {
         
            if(($this->session->userdata('logged_in')) && ($this->session->userdata('admin')==1))
            {
                $data['base']=$this->config->item('base_url');
                $data['title']="Ornagai :: Admin Dashboard";
                $this->load->model("users");
                $this->load->model("words");
                $data['total_users']=$this->users->get_totalusr();
               
                $data['en_unapprove']=$this->words->get_unapprove_total();
                $data['en_total']=$this->words->get_en_total();
                
                $data['my_unapprove']=$this->words->get_my_unapprove_total();
                $data['my_total']=$this->words->get_mm_total();
                $this->load->view("admin_dashboard_view",$data);
            }
            else
            {
                 redirect("/admin/login");
            }
        }
        
        function enunapprove()
        {
        	$this->load->model('words');
        	
        	$data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: English Unapprove Word";
            $data['controller_approve']= 'enapprove';
            $data['controller_remove']= 'enremove';
            $this->load->model("words");
            $total_words=$this->words->get_unapprove_total();
            
            $per_pg=10;
            $start=0;
            if ($this->uri->segment(3) != "" )	$start= $this->uri->segment(3);
            $data['wordlist']=$this->words->get_enunapprove_list($start,$per_pg);
            
            $this->load->library('pagination');
            
            $config['base_url']=$data['base'].'/index.php/admin/enunapprove';
            $config['total_rows']=$total_words;
            $config['per_page']=$per_pg;
            
            $this->pagination->initialize($config);
             
            $data['paging']=$this->pagination->create_links();
            
        	$this->load->view('admin_unapprove_list',$data);
        	
        	
        }

        //Myanmar Unapprove
        function myunapprove()
        {
        	$this->load->model('words');

        	$data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: Myanmar Unapprove Word";
            $data['controller_approve']= 'myapprove';
            $data['controller_remove']= 'myremove';

            $this->load->model("words");
            $total_words=$this->words->get_my_unapprove_total();
          
            $per_pg=10;
            $start=0;
            
            if ($this->uri->segment(3) != "" )	$start= $this->uri->segment(3);
          	
            
            $data['wordlist']=$this->words->get_myunapprove_list($start,$per_pg);
            
            $this->load->library('pagination');
            
            $config['base_url']=$data['base'].'/index.php/admin/myunapprove';
            $config['total_rows']=$total_words;
            $config['per_page']=$per_pg;

            $this->pagination->initialize($config);

			
            $data['paging']=$this->pagination->create_links();
			
        	$this->load->view('admin_unapprove_list',$data);


        }
        
        function login()
        {
            $data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: Admin Login";
            
            if(isset($_POST['username']))
            {
                $username=$_POST['username'];
                $password=$_POST['password'];
                
                $this->load->model("users");
                
                $result=$this->users->login($username,$password,true);
                
             
                if($result)
                    redirect("/admin/index");
                else
                    redirect("/admin/login/err");
                     
            }
            else
            {
                if($this->uri->segment(3)=="err")   $data['err']="username or password incorrect";
                $this->load->view("adminlogin_view.php",$data);
            }
        }
        
        function usr_ban()
        {
            //Get user Id
            if($this->uri->segment(3)!="")
            {
            	$usrid=$this->uri->segment(3);
            }
            else
            {
            	$usrid=spliti(",",$_POST['id']);
            } 
            
            $this->load->model("users");
            $this->users->ban($usrid);
        }
        
        function usr_unban()
        {
            //Get user Id
            if($this->uri->segment(3)!="")
            {
            	$usrid=$this->uri->segment(3);
            }
            else
            {
            	$usrid=spliti(",",$_POST['id']);
            } 
            
            $this->load->model("users");
            $this->users->unban($usrid);
        }
        
        function users()
        {
           	$data['base']=$this->config->item('base_url');
           	$data['title']="Ornagai :: Users Manager";
           
           	$this->load->model("users");
          
           	$total_users=$this->users->get_totalusr();
            
            
            $per_pg=10;
            $start=0;
            if ($this->uri->segment(3) != "" )             $start= $this->uri->segment(3);
          
          	$data['userlist']=$this->users->getlist($start,$per_pg);
            $this->load->library('pagination');

            $config['base_url'] = $data['base'].'/index.php/admin/users/';
            $config['total_rows'] =$total_users;
            $config['per_page'] =$per_pg;
    
            $this->pagination->initialize($config);
    		
            $data['paging']= $this->pagination->create_links();
    
            $this->load->view("admin_user",$data);
     
        }
        
        function usr_del()
        {
        	if($this->uri->segment(3)!="")
        	{
        		$usrid=$this->uri->segment(3);
        	}
        	else
        	{
        		$usrid=spliti(',',$_POST['id']);
        	}
        	$this->load->model("users");
        	$this->users->del($usrid);
        }
        
        function usr_edit()
        {
        	$usrid=$this->uri->segment(3);
        	$this->load->model("users");
        	$data['userinfo']=$this->users->info($usrid);
        	
        	$this->load->view("admin_user_edit",$data);
        }
        function enapprove()
        {
        	if($this->uri->segment(3)!="")
        	{
        		$id=$this->uri->segment(3);
        	}
        	else
        	{
        		$id=spliti(',',$_POST['id']);
        	}
        	$this->load->model("words");
        	$this->words->en_approve($id);
        }
        
        function enremove()
        {
        	if($this->uri->segment(3)!="")
        	{
        		$id=$this->uri->segment(3);
        	}
        	else
        	{
        		$id=spliti(',',$_POST['id']);
        	}
        	$this->load->model("words");
        	$this->words->en_remove($id);
        }
        
        function myremove()
        {
        	if($this->uri->segment(3)!="")
        	{
        		$id=$this->uri->segment(3);
        	}
        	else
        	{
        		$id=spliti(',',$_POST['id']);
        	}
        	$this->load->model("words");
        	$this->words->my_remove($id);
        }
        
        function myapprove()
        {
        	if($this->uri->segment(3)!="")
        	{
        		$id=$this->uri->segment(3);
        	}
        	else
        	{
        		$id=spliti(',',$_POST['id']);
        	}
        	$this->load->model("words");
        	$this->words->my_approve($id);
        }
        
        function user_update()
        {
        	$ban=0;
   			if($_POST['ban']=="true")
   			{
   				$ban=1;
   			}
        	$data = array(
        	       'username' => $_POST['username'] ,
        	       'email'=>$_POST['email'],
        	       'join_date' =>$_POST['join_date'],
        	       'ban'=>$ban
        	    );
        	
        	$this->load->model("users");
        	$this->users->update($_POST['id'],$data);
        }
}
?>