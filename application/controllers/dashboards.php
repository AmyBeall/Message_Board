<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboards extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		$this->load->model('Dashboard');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('level');
		$this->load->view('index_UD');
	}
	public function sign_in()
	{
		$this->load->view('sign_in');
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function add_user()
	{
		$id = $this->session->userdata('id');
		$user['user'] = $this->Dashboard->get_user_by_id($id);
		$this->load->view('add_users', $user);
	}
	public function display_users()
	{
		$all['all_users'] = $this->Dashboard->all();
		$this->load->view('display_users', $all);
	}
	public function manage_users()
	{
		$id = $this->session->userdata('id');
		$all['user'] = $this->Dashboard->get_user_by_id($id);
		$all['all_users'] = $this->Dashboard->all();
		$this->load->view('manage_users', $all);
	}
	public function edit_users($id)
	{
		$user['user'] = $this->Dashboard->get_user_by_id($id);
		$this->load->view('edit_user', $user);
	}
	public function board($id = NULL)
	{
		if($id == NULL)
		{
			$admin_id = 1;
			$id = $admin_id;
		}
	
		$user_data['user'] = $this->Dashboard->get_user_by_id($id);
		$user_data['messages'] = $this->Dashboard->get_messages_by_id($id);
		$user_data['comments'] = $this->Dashboard->get_comments_by_id($id);
		$user_data['all_users'] = $this->Dashboard->all();
		$this->load->view('message_board', $user_data);
	}
	public function profile()
	{
		$id = $this->session->userdata('id');
		$user['user'] = $this->Dashboard->get_user_by_id($id);
		$this->load->view('edit_profile', $user);
	}
	public function admin_update_user_info($id)
	{
		$user_info['email'] = $this->input->post('email');
		$user_info['user_name'] = $this->input->post('user_name');
		$user_info['first_name'] = $this->input->post('first_name');
		$user_info['last_name'] = $this->input->post('last_name');
		if($this->input->post('level') == "admin")
		{
			$user_info['level'] = 9;
		}
		else
		{
			$user_info['level'] = 2;
		}

		$user_info['id'] = $id;
		$this->Dashboard->admin_update_user_info($user_info);
		redirect('/dashboards/manage_users/');
	}
	public function delete_user($id)
	{
		$this->Dashboard->delete_user_by_id($id);
		redirect('/dashboards/manage_users');
	}
	public function update_user_info()
	{
		$user_info['email'] = $this->input->post('email');
		$user_info['first_name'] = $this->input->post('first_name');
		$user_info['last_name'] = $this->input->post('last_name');
		$user_info['id'] = $this->session->userdata('id');
		$this->Dashboard->update_user_info($user_info);
		redirect('/dashboards/profile');
	}
	public function admin_update_password($id)
	{
		$user_info['password'] = md5($this->input->post('password'));
		$user_info['confirm'] = md5($this->input->post('confirm'));
		$user_info['id'] = $id;
		if ($user_info['password'] == $user_info['confirm'])
		{
		$this->Dashboard->update_password($user_info);
		redirect('/dashboards/manage_users');
		}
		else
		{
		$error = "Password and Confirm password must match!";
		$this->session->set_userdata('error', $error);
		redirect('/dashboards/manage_users');
		}	
	}
	public function admin_add_user()
	{
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['user_name'] = $this->input->post('user_name');
		$data['email'] = $this->input->post('email');
		$data['password'] = md5($this->input->post('password'));
		$data['confirm'] = md5($this->input->post('confirm'));
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("user_name", "User Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|is_unique[users.email_address]|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm", "Confirm Password", "trim|required|min_length[8]|matches[password]");
		
		if($this->form_validation->run())
		{
		    $new_user = $this->Dashboard->add($data);
		    $login_user['user'] = $this->Dashboard->check($data);
		    $user_id = $login_user['user']['id'];
			$user_level = $login_user['user']['user_level'];
			$this->session->set_userdata('level', $user_level);
			$this->session->set_userdata('id', $user_id);
			redirect('/dashboards/manage_users');
		}
		else
		{
			$id = $this->session->userdata('id');
			$view_data['user'] = $this->Dashboard->get_user_by_id($id);
		    $view_data["errors"] = validation_errors();
		    $this->load->view('add_users', $view_data);
		}
	}
	public function update_password()
	{
		$user_info['password'] = md5($this->input->post('password'));
		$user_info['confirm'] = md5($this->input->post('confirm'));
		$user_info['id'] = $this->session->userdata('id');
		if ($user_info['password'] == $user_info['confirm'])
		{
		$this->Dashboard->update_password($user_info);
		redirect('/dashboards/profile');
		}
		else
		{
		$error = "Password and Confirm password must match!";
		$this->session->set_userdata('error', $error);
		redirect('/dashboards/profile');
		}	
	}
	public function update_description()
	{
		$user_info['description'] = $this->input->post('description');
		$user_info['id'] = $this->session->userdata('id');
		$this->Dashboard->update_description($user_info);
		redirect('/dashboards/profile');
	}
	public function login()
	{
		$data['user_name'] = $this->input->post('user_name');
		$data['password'] = md5($this->input->post('password'));
		$login_user['user'] = $this->Dashboard->check($data);
		if(empty($data['user_name'] || $data['password']))
		{
			$error['errors'] = "Your user name or password cannot be empty!!!";	
			$this->load->view('register', $error);
		}
		elseif(empty($login_user['user']))
		{
			$error['errors'] = "User not found!!!";	
			$this->load->view('sign_in', $error);
		}	
		elseif($login_user['user']['user_name'] == $data['user_name'] && $login_user['user']['password'] == $data['password'])
		{	
			$user_id = $login_user['user']['id'];
			$user_level = $login_user['user']['user_level'];
			$this->session->set_userdata('level', $user_level);
			$this->session->set_userdata('id', $user_id);
			redirect('/dashboards/board/');
		}
		else
		{
			$error['errors'] = "Your user name and password do not match!!!";	
		}
		
	}
	public function registration()
	{
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['user_name'] = $this->input->post('user_name');
		$data['email'] = $this->input->post('email');
		$data['password'] = md5($this->input->post('password'));
		$data['confirm'] = md5($this->input->post('confirm'));
		$this->form_validation->set_rules("first_name", "First Name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required");
		$this->form_validation->set_rules("user_name", "User Name", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|is_unique[users.email_address]|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm", "Confirm Password", "trim|required|min_length[8]|matches[password]");
		
		if($this->form_validation->run())
		{
		    $new_user = $this->Dashboard->add($data);
		    $login_user['user'] = $this->Dashboard->check($data);
		    $user_id = $login_user['user']['id'];
			$user_level = $login_user['user']['user_level'];
			$this->session->set_userdata('level', $user_level);
			$this->session->set_userdata('id', $user_id);
			redirect('/dashboards/board');
		}
		else
		{

		    $view_data["errors"] = validation_errors();
		    $this->load->view('register', $view_data);
		}
	}
	function message($id)
	{
		$id = $id;
		$message['user_id'] = $id;
		$message['message'] = $this->input->post('message');
		$message['creator_id'] = $this->input->post('creator_id');
		$this->Dashboard->insert_message($message);
		$user_data['user'] = $this->Dashboard->get_user_by_id($id);
		$user_data['comments'] = $this->Dashboard->get_comments_by_id($id);
		$user_data['messages'] = $this->Dashboard->get_messages_by_id($id);
		$user_data['all_users'] = $this->Dashboard->all();
		$this->load->view('message_board', $user_data);
	}
	function comment($id)
	{
		$comment['user_id'] = $id;
		$comment['comment'] = $this->input->post('draft_comment');
		$comment['message_id'] = $this->input->post('message_id');
		$comment['creator_id'] = $this->input->post('creator_id');
		$this->Dashboard->insert_comment($comment);
		$user_data['user'] = $this->Dashboard->get_user_by_id($id);
		$user_data['comments'] = $this->Dashboard->get_comments_by_id($id);
		$user_data['messages'] = $this->Dashboard->get_messages_by_id($id);
		$user_data['all_users'] = $this->Dashboard->all();
		$this->load->view('message_board', $user_data);
	}

}
//end of main controller