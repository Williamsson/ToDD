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
	
	function register(){
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
				redirect('user/register');
				
			}
		}
		
		$data = array(
				'title' => "ToD - Register",
				'mainContent' => "register_view.php",
				'description' => "Register to the site",
				'keyword' => "nycklar",
		);
		$this->load->view('template.php', $data);
	}
}