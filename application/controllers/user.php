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
}