<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboards extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
		$this->load->model('Dashboard');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function login()
	{
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$login_user['user'] = $this->login->check($data);
		if(empty($data['email'] || $data['password']))
		{
			$error['errors'] = "Your user name or password cannot be empty!!!";	
			$this->load->view('display_login', $error);
		}
		elseif(empty($login_user['user']))
		{
			$error['errors'] = "Your user name and password do not match!!!";	
			$this->load->view('display_login', $error);
		}	
		elseif($login_user['user']['email'] == $data['email'] && $login_user['user']['password'] == $data['password'])
		{	
			$this->load->view('welcome', $login_user);
		}
		
	}
	public function registration()
	{
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');
		$data['confirm'] = $this->input->post('confirm');
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|is_unique[users.email]|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm", "Confirm Password", "trim|required|min_length[8]|matches[password]");
		
		if($this->form_validation->run())
		{
		    $new_user = $this->login->add($data);
		    $login_user['user'] = $this->login->check($data);
		    $this->load->view('welcome', $login_user);
		}
		else
		{

		    $view_data["errors"] = validation_errors();
		    $this->load->view('display_login', $view_data);
		}
	}
}

}

//end of main controller