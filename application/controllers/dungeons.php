<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dungeons extends CI_Controller {
	
	public function index(){
		$data = array(
				'title' => "ToD - Dungeons",
				'mainContent' => "dungeon_view.php",
				'description' => "List of all the dungeons",
		);
		$this->load->view('template.php', $data);
	}
	
	public function more(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('page');
		}
		
		$data = array(
				'title' => "ToD - Dungeons: More",
				'mainContent' => "dungeon_more_view.php",
				'description' => "Shows more information of a dungeon",
		);
		$this->load->view('template.php', $data);
		
	}
	
	public function add(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			$this->session->set_flashdata('message', "<div class='error'>You don't have permission to do that.</div>");
			redirect('admin');
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
					
					$config1['image_library'] = 'gd2';
					$config1['source_image']	= "./uploads/$dungeonImageFileName";
					$config1['new_image'] = "./uploads/thumbs/$dungeonImageFileName";
					$config1['create_thumb'] = TRUE;
					$config1['thumb_marker'] = '';
					$config1['maintain_ratio'] = TRUE;
					$config1['width']	 = 160;
					$config1['height']	= 140;
					
					$this->load->library('image_lib', $config1);
					$this->image_lib->resize();
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
				
				$result = $this->dungeon_model->addDungeon($name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins, 
											$finished, $public, $responsible, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName);
				
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Dungeon $name was created successfully!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>The creation of the dungeon '$name' failed for some reason.</div>");
				}
				redirect('/dungeons');
			}
		}
		$data = array(
				'title' => "ToD - Add dungeon",
				'mainContent' => "dungeon_add_view.php",
				'description' => "Add dungeon",
		);
		$this->load->view('template.php', $data);
	}
	
	public function edit(){
		
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			$this->session->set_flashdata('message', "<div class='error'>You don't have permission to do that.</div>");
			redirect('admin');
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
			$this->form_validation->set_rules('id','ID','integer|required|xss_clean');
			$this->form_validation->set_rules('finished','Finished','required|integer|xss_clean');
			$this->form_validation->set_rules('public','Finished','required|integer|xss_clean');
			$this->form_validation->set_rules('description','Description','required|xss_clean');
			$this->form_validation->set_rules('other','Other','xss_clean');
			
			if ($this->form_validation->run() == TRUE){
				$dungeonImageFileName = "";
				
				$this->db->select('image');
				$this->db->where('id',$this->input->post('id'));
				$query = $this->db->get('temples');
					
				foreach($query->result() as $row){
					$oldImage = $row->image;
				}
				
				if ($_FILES['dungeonImage']['error'] != 4){
					
					unlink("./uploads/$oldImage");
					unlink("./uploads/thumbs/$oldImage");
					
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
						
					$config1['image_library'] = 'gd2';
					$config1['source_image']	= "./uploads/$dungeonImageFileName";
					$config1['new_image'] = "./uploads/thumbs/$dungeonImageFileName";
					$config1['create_thumb'] = TRUE;
					$config1['thumb_marker'] = '';
					$config1['maintain_ratio'] = TRUE;
					$config1['width']	 = 160;
					$config1['height']	= 140;
						
					$this->load->library('image_lib', $config1);
					$this->image_lib->resize();
				}else{
					echo $dungeonImageFileName = $oldImage;
				}
		
		
				$id = $this->input->post('id');
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
				
				$result = $this->dungeon_model->updateDungeon($id, $name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins,
						$finished, $public, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName);
		
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Dungeon $name was successfully edited!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>The editing of the dungeon '$name' failed for some reason.</div>");
				}
				redirect("/dungeons/more/$id");
			}
		}
		$data = array(
				'title' => "ToD - Edit dungeon",
				'mainContent' => "dungeon_edit_view.php",
				'description' => "Edit a dungeon",
		);
		$this->load->view('template.php', $data);
		
	}
	
	function delete(){
		if(!$this->safety_model->isLoggedIn() || !$this->user_model->isAdmin()){
			redirect('admin');
		}
		
		if($this->input->post()){
			$this->form_validation->set_rules('id','The ID','required|integer|xss_clean');
				
			if ($this->form_validation->run() == TRUE){
					
				$id = $this->input->post('id');
		
				$result = $this->dungeon_model->removeDungeon($id);
		
				if($result){
					$this->session->set_flashdata('message', "<div class='success'>Dungeon was successfully removed!</div>");
				}else{
					$this->session->set_flashdata('message', "<div class='error'>Removing the dungeon failed for some reason. I blame Molgan.</div>");
				}
				redirect('/dungeons');
			}
		}
		
		$data = array(
				'title' 		=> "KBK - Remove dungeon",
				'mainContent' 	=> "dungeon_delete_view.php",
				'description' 	=> "Remove the dungeon",
				'keyword' 		=> "",
		);
		$this->load->view('template.php', $data);
	}
	
}