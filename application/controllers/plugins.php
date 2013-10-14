<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugins extends CI_Controller {
	
	public function index(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
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
			$this->form_validation->set_rules('downloadLink','Download link','required|xss_clean');
			$this->form_validation->set_rules('wikiLink','Wiki link','xss_clean');
			$this->form_validation->set_rules('description','Description','required|xss_clean');
			$this->form_validation->set_rules('active','Active','required|xss_clean');
			$this->form_validation->set_rules('broken','broken','required|xss_clean');
			
			if ($this->form_validation->run() == TRUE){
				
				$name = $this->input->post('pluginName');
				$dlLink = $this->input->post('downloadLink');
				$wikiLink = $this->input->post('wikiLink');
				$desc = $this->input->post('description');
				$active = $this->input->post('active');
				$broken = $this->input->post('broken');
				
				
				$result = $this->general_model->addPlugin($name, $dlLink, $wikiLink, $desc, $active, $broken);
				
				if($result){
					$this->session->set_flashdata('pluginCreate', "<div class='success'>Plugin '$name' was added successfully!</div>");
				}else{
					$this->session->set_flashdata('pluginCreate', "<div class='error'>Adding the plugin '$name' failed for some reason.</div>");
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
	
}