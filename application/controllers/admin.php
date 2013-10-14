<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		$data = array(
				'title' => "KBK - Admin",
				'mainContent' => "admin_view.php",
				'description' => "En sida",
				'keyword' => "nycklar",
		);
		$this->load->view('template.php', $data);
	}
}