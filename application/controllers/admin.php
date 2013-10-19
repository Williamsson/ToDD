<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index(){
		if(!$this->safety_model->isLoggedIn() && $this->safety_model->hasPermission(array('2','3'))){
			redirect('page');
		}
		
		$data = array(
				'title' => "KBK - Admin",
				'mainContent' => "admin_view.php",
				'description' => "En sida",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
	}
	
	public function manageUsers(){
		if(!$this->safety_model->isLoggedIn() && $this->user_model->isAdmin()){
			redirect('page');
		}
		
		$data = array(
				'title' => "",
				'mainContent' => "users_manage_view.php",
				'description' => "Manage users",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
	}
	
}