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
                $word=$this->words->get_en_unapprove();
                $data['en_unapprove']=$word->num_rows();
                $word=$this->words->get_my_unapprove();
                $data['my_unapprove']=$word->num_rows();
                $this->load->view("admin_dashboard_view",$data);
                //$data['total']
                //total user
                //total unapprove word
                //total approve word
            }
            else
            {
                 redirect("/admin/login");
            }
        }
        
        function enunapprove()
        {
        	$this->load->model('words');
        	$data['query']=$this->words->get_en_unapprove();
        	$data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: English Unapprove Word";
        	$this->load->view('admin_en_unapprove',$data);
        	
        	
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
        
         function usr_del()
        {
            
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

            $config['base_url'] = $data['base'].'/admin/users/';
            $config['total_rows'] =$total_users;
            $config['per_page'] =$per_pg;
    
            $this->pagination->initialize($config);
    
            $data['paging']= $this->pagination->create_links();
    
            $this->load->view("admin_user",$data);
     
        }
}
?>