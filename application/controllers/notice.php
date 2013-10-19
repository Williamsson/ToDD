<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index(){
		if(!$this->safety_model->isLoggedIn() && $this->safety_model->hasPermission(array('2','3'))){
			redirect('page');
		}
	}		
	
	public function add(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
	}
	
	
	public function edit(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
	}
	
	public function delete(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
	}

}