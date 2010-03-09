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
                
                $data['my_unapprove']=$this->words->get_my_unapprove_total();
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
             $usrid=$this->uri->segment(3);
             
             $this->db->where("id",$usrid);
             $query=$this->db->get("user");
             //Get Last Record
             $res=$query->result();
             $ban=$res[0]->ban;
             
            if($ban==0) $data = array("ban"=>1);
            else  $data = array("ban"=>0);
           
            $this->db->where("id",$usrid);
            $this->db->update("user",$data);
            redirect("/admin/users/");
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
        
        function enapprove()
        {
        	$id=$_POST['enid'];
        	$this->load->model("words");
        	$this->words->en_approve($id);
        }
}
?>