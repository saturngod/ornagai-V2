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
                $data['total_users']=$this->users->get_totalusr();
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
        
        function users()
        {
             $data['base']=$this->config->item('base_url');
            $data['title']="Ornagai :: Users Manager";
            
            $this->load->model("users");
            $data['userlist']=$this->users->getlist();
          $this->load->view("admin_user",$data);
            
/*            $this->load->library('pagination');


$config['base_url'] = 'http://localhost/ornagai-v1/index.php/admin/users/';
$config['total_rows'] = '200';
$config['per_page'] = '20';

$this->pagination->initialize($config);

echo $this->pagination->create_links();
*/        
        }
}
?>