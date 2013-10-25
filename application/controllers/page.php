<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index(){
		$data = array(
					'title' => "KBK - Page",
					'mainContent' => "index_view.php",
					'description' => "",
					'keyword' => "",
					);
		$this->load->view('template.php', $data);
	}
	
	public function view(){
		
		$data = array(
				'title' => "KBK - Page",
				'mainContent' => "page_view.php",
				'description' => "",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
	}
	
	public function listPages(){
		
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		$data = array(
				'title' => "KBK - Manage pages",
				'mainContent' => "page_management_view.php",
				'description' => "",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
		
	}
	
}

