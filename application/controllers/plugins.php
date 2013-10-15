<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugins extends CI_Controller {
	
	public function index(){
		if(!$this->safety_model->isLoggedIn() || !$this->safety_model->hasPermission(array('2','3'))){
			redirect('page');
		}
		$data = array(
				'title' => "KBK - Plugin management",
				'mainContent' => "plugin_view.php",
				'description' => "En sida",
				'keyword' => "nycklar",
		);
		$this->load->view('template.php', $data);
	}
	
	function add(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
			
			
			$this->form_validation->set_rules('pluginName','Plugin name','required|xss_clean');
			$this->form_validation->set_rules('version','Version','xss_clean');
			$this->form_validation->set_rules('updated','Last updated','xss_clean');
			$this->form_validation->set_rules('downloadLink','Download link','required|xss_clean');
			$this->form_validation->set_rules('wikiLink','Wiki link','xss_clean');
			$this->form_validation->set_rules('description','Description','required|xss_clean');
			$this->form_validation->set_rules('active','Active','required|xss_clean');
			$this->form_validation->set_rules('broken','broken','required|xss_clean');
			
			if ($this->form_validation->run() == TRUE){
				
				$name = $this->input->post('pluginName');
				$version = $this->input->post('version');
				$updated = $this->input->post('updated');
				$dlLink = $this->input->post('downloadLink');
				$wikiLink = $this->input->post('wikiLink');
				$desc = $this->input->post('description');
				$active = $this->input->post('active');
				$broken = $this->input->post('broken');
				
				
				$result = $this->plugin_model->addPlugin($name, $version, $updated, $dlLink, $wikiLink, $desc, $active, $broken);
				
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Plugin '$name' was added successfully!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Adding the plugin '$name' failed for some reason.</div>");
				}
				redirect('/plugins/add');
				
			}
			
			
		}
		$data = array(
				'title' => "KBK - Plugin management",
				'mainContent' => "add_plugin_view.php",
				'description' => "En sida",
				'keyword' => "nycklar",
		);
		$this->load->view('template.php', $data);
		
	}
	
	function remove(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		
		if($this->input->post()){
			$this->form_validation->set_rules('id','The ID','required|integer|xss_clean');
			
			if ($this->form_validation->run() == TRUE){
			
				$id = $this->input->post('id');
				
				$result = $this->plugin_model->removePlugin($id);
				
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Plugin was successfully removed!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Removing the plugin failed for some reason. I blame Molgan.</div>");
				}
				redirect('/plugins');
				
			}
		}
		
		$data = array(
				'title' 		=> "KBK - Remove plugin",
				'mainContent' 	=> "remove_plugin_view.php",
				'description' 	=> "En sida",
				'keyword' 		=> "nycklar",
		);
		$this->load->view('template.php', $data);
		
	}
	
	function edit(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
			$this->form_validation->set_rules('pluginName','Plugin name','required|xss_clean');
			$this->form_validation->set_rules('id','ID','integer|required|xss_clean');
			$this->form_validation->set_rules('version','Version','xss_clean');
			$this->form_validation->set_rules('updated','Last updated','xss_clean');
			$this->form_validation->set_rules('downloadLink','Download link','required|xss_clean');
			$this->form_validation->set_rules('wikiLink','Wiki link','xss_clean');
			$this->form_validation->set_rules('description','Description','required|xss_clean');
			$this->form_validation->set_rules('active','Active','required|xss_clean');
			$this->form_validation->set_rules('broken','broken','required|xss_clean');
			
			if ($this->form_validation->run() == TRUE){
				
				$id = $this->input->post('id');
				$name = $this->input->post('pluginName');
				$version = $this->input->post('version');
				$updated = $this->input->post('updated');
				$dlLink = $this->input->post('downloadLink');
				$wikiLink = $this->input->post('wikiLink');
				$desc = $this->input->post('description');
				$active = $this->input->post('active');
				$broken = $this->input->post('broken');
				
				
				$result = $this->plugin_model->updatePlugin($id, $name, $version, $updated, $dlLink, $wikiLink, $desc, $active, $broken);
				
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Plugin '$name' was successfully edited!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Editing the plugin '$name' failed for some reason. I blame Torsten.</div>");
				}
				redirect('/plugins');
			}
		}
		
		$data = array(
				'title' 		=> "KBK - Edit plugin",
				'mainContent' 	=> "edit_plugin_view.php",
				'description' 	=> "En sida",
				'keyword' 		=> "nycklar",
		);
		$this->load->view('template.php', $data);
	}
	
	
	
	
	
}