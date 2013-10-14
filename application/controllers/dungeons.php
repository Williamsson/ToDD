<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dungeons extends CI_Controller {
	
	public function index(){
		$data = array(
				'title' => "ToD - Dungeons",
				'mainContent' => "dungeons_view.php",
				'description' => "List of all the dungeons",
		);
		$this->load->view('template.php', $data);
	}
	
	public function add(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		if($this->input->post()){
			
			$this->form_validation->set_rules('entrancePosX','Entrance position X','required|integer|xss_clean');
			$this->form_validation->set_rules('entrancePosY','Entrance position Y','required|integer|xss_clean');
			$this->form_validation->set_rules('entrancePosZ','Entrance position Z','required|integer|xss_clean');
			
			$this->form_validation->set_rules('hasBravery','Has bravery','required|integer|xss_clean');
			$this->form_validation->set_rules('minBravery','Minimum bravery','integer|xss_clean');
			$this->form_validation->set_rules('maxBravery','Maximum bravery','integer|xss_clean');
			$this->form_validation->set_rules('rewardBravery','Bravery reward','integer|xss_clean');
			$this->form_validation->set_rules('costBravery','Bravery cost','integer|xss_clean');
			
			$this->form_validation->set_rules('dungeonName','Name','required|xss_clean');
			$this->form_validation->set_rules('finished','Finished','required|integer|xss_clean');
			$this->form_validation->set_rules('public','Finished','required|integer|xss_clean');
			$this->form_validation->set_rules('description','Description','required|xss_clean');
			$this->form_validation->set_rules('other','Other','xss_clean');
			
			
			if ($this->form_validation->run() == TRUE){
				$dungeonImageFileName = "";
				
				if ($_FILES['dungeonImage']['error'] != 4){
					$this->load->helper('string');
					
					$fileName = random_string('alnum', 64);
					
					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '2048';
					$config['max_width']  = '1920';
					$config['max_height']  = '1058';
					$config['file_name']	= $fileName;
					
					$this->load->library('upload', $config);
					
					if (!$this->upload->do_upload('dungeonImage')){
						$error = array('error' => $this->upload->display_errors());
					}
					else{
						$data = array('upload_data' => $this->upload->data());
					}
					
					$dungeonImageFileName = $fileName . "." . pathinfo($_FILES['dungeonImage']['name'], PATHINFO_EXTENSION);
				}
				
				
				$name = $this->input->post('dungeonName');
				$desc = $this->input->post('description');
				$other = $this->input->post('other');
				$finished = $this->input->post('finished');
				$public = $this->input->post('public');
				
				$entrancePosX = $this->input->post('entrancePosX');
				$entrancePosY = $this->input->post('entrancePosY');
				$entrancePosZ = $this->input->post('entrancePosZ');
				
				$hasBravery = $this->input->post('hasBravery');
				$minBravery = $this->input->post('minBravery');
				$maxBravery = $this->input->post('maxBravery');
				$rewardBravery = $this->input->post('rewardBravery');
				$costBravery = $this->input->post('costBravery');
				
				$plugins = $this->input->post('plugins');
				$responsible = $this->session->userdata('userId');
				
				$result = $this->general_model->addDungeon($name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins, 
											$finished, $public, $responsible, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName);
				
				if($result){
					$this->session->set_flashdata('dungeonCreate', "<div class='success'>Dungeon $name was created successfully!</div>");
				}else{
					$this->session->set_flashdata('dungeonCreate', "<div class='error'>The creation of the dungeon '$name' failed for some reason.</div>");
				}
				redirect('/dungeons/add');
			}
		}
		
		
		$data = array(
				'title' => "ToD - Add dungeon",
				'mainContent' => "add_dungeon_view.php",
				'description' => "Add dungeon",
		);
		$this->load->view('template.php', $data);
	}
	
}