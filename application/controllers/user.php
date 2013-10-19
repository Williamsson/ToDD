<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function index(){
		
	}
	
	function login(){
		if($this->input->post('username')){
			$username = $this->input->post('username');
			$password = hash('sha1', $this->input->post('password'));
			
			$this->user_model->login($username, $password);
		}
		redirect('');
	}
	
	function logout(){
		$this->user_model->logout();
		redirect('page');
	}
	
	function add(){
		if($this->input->post()){
			$this->form_validation->set_rules('username','Username','alpha|required|xss_clean');
			$this->form_validation->set_rules('password','Password','required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('rpassword','Repeat password','required|matches[password]|xss_clean');
			$this->form_validation->set_rules('description','Description','xss_clean');
			
			if ($this->form_validation->run() == TRUE){
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));
				$desc = $this->input->post('description');
				
				$result = $this->user_model->addUser($username, $password, $desc);
				
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Success! Now wait until someone activates your account.</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Sadly, something went wrong.</div>");
				}
				redirect('user/add');
				
			}
		}
		
		$data = array(
				'title' => "ToD - Register",
				'mainContent' => "user_add_view.php",
				'description' => "Register to the site",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
	}
	
	function delete($id){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
			$this->form_validation->set_rules('id','The ID','required|integer|xss_clean');
				
			if ($this->form_validation->run() == TRUE){
				$id = $this->input->post('id');
		
				$result = $this->user_model->deleteUser($id);
		
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>User was successfully removed!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Removing the user failed for some reason. I blame Molgan.</div>");
				}
				redirect('/admin/manageUsers');
			}
		}
		$data = array(
				'title' 		=> "KBK - Remove user",
				'mainContent' 	=> "user_delete_view.php",
				'description' 	=> "Remove a user from the system",
				'keyword' 		=> "",
		);
		$this->load->view('template.php', $data);
	}
	
	function updatePermission(){
		
		if(!$this->input->post()){
			redirect('admin');
		}
		
		$this->form_validation->set_rules('permission','Permission','integer|required|xss_clean');
		$this->form_validation->set_rules('id','ID','integer|required|xss_clean');
		
		if($this->form_validation->run() == TRUE){
			$result = $this->user_model->updateUserPermission($this->input->post('id'),$this->input->post('permission'));
			
			if($result){
				$this->session->set_flashdata('message', "<div class='success'>Success! Permission changed (Need to log out and in).</div>");
			}else{
				$this->session->set_flashdata('message', "<div class='error'>Sadly, something went wrong.</div>");
			}

			redirect('admin/manageUsers');
			
		}
		
		echo "<pre>";
		print_r($this->input->post());
		die();
		
	}
	
}