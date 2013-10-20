<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends CI_Controller {
	
	public function index(){
		if(!$this->safety_model->isLoggedIn() && $this->safety_model->hasPermission(array('2','3'))){
			redirect('page');
		}
	}		
	
	public function add(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
				
			$this->form_validation->set_rules('author','author','integer|required|xss_clean');
			$this->form_validation->set_rules('title','Title','required|xss_clean');
			$this->form_validation->set_rules('posted','posted','required|xss_clean');
			$this->form_validation->set_rules('visibility','visibility','required|xss_clean');
			$this->form_validation->set_rules('content','content','required|xss_clean');
				
			if ($this->form_validation->run() == TRUE){
		
				$id = $this->input->post('author');
				$title = $this->input->post('title');
				$posted = $this->input->post('posted');
				$visibility = $this->input->post('visibility');
				$content = $this->input->post('content');
		
		
				$result = $this->notice_model->addNotice($id,$title,$posted,$visibility,$content);
		
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Newspost '$title' was added successfully!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Adding the newspost '$title' failed for some reason.</div>");
				}
				redirect('/admin');
		
			}
				
				
		}
		$data = array(
				'title' => "KBK - Add notice",
				'mainContent' => "notice_add_view.php",
				'description' => "",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
	}
	
	
	public function edit(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
				
			$this->form_validation->set_rules('id','ID','integer|required|xss_clean');
			$this->form_validation->set_rules('title','Title','required|xss_clean');
			$this->form_validation->set_rules('posted','posted','required|xss_clean');
			$this->form_validation->set_rules('visibility','visibility','integer|required|xss_clean');
			$this->form_validation->set_rules('content','content','required|xss_clean');
			
			if ($this->form_validation->run() == TRUE){
				
				$id = $this->input->post('id');
				$title = $this->input->post('title');
				$posted = $this->input->post('posted');
				$visibility = $this->input->post('visibility');
				$content = $this->input->post('content');
				
		
				$result = $this->notice_model->updateNotice($id,$title,$posted,$visibility,$content);
		
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Newspost '$title' was edited successfully!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Editing the newspost '$title' failed for some reason.</div>");
				}
				redirect('/admin');
		
			}
				
				
		}
		$data = array(
				'title' => "KBK - Edit notice",
				'mainContent' => "notice_edit_view.php",
				'description' => "",
				'keyword' => "",
		);
		$this->load->view('template.php', $data);
	}
	
	public function delete(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
			$this->form_validation->set_rules('id','The ID','required|integer|xss_clean');
				
			if ($this->form_validation->run() == TRUE){
					
				$id = $this->input->post('id');
		
				$result = $this->notice_model->deleteNotice($id);
		
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Notice was successfully removed!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Removing the notice failed for some reason. I blame Molgan.</div>");
				}
				redirect('/admin');
		
			}
		}
		
		$data = array(
				'title' 		=> "KBK - Delete notice",
				'mainContent' 	=> "notice_delete_view.php",
				'description' 	=> "Removing a notice",
				'keyword' 		=> "",
		);
		$this->load->view('template.php', $data);
	}
	
	public function more(){
		$data = array(
				'title' => "ToD - Newspost",
				'mainContent' => "notice_more_view.php",
				'description' => "Read more of a newspost",
		);
		$this->load->view('template.php', $data);
		
	}

}