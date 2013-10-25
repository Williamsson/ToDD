<?php 
class Dungeon_model extends CI_Model{
	
	function addDungeon($name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins, 
						$finished, $visibility, $responsible, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName){
		$data = array(
			'name'			=> $name,
			'entrancePosX'	=> $entrancePosX,
			'entrancePosY'	=> $entrancePosY,
			'entrancePosZ'	=> $entrancePosZ,
			'description'	=> $desc,
			'other'			=> $other,
			'is_finished'	=> $finished,
			'visibility'	=> $visibility,
			'hasBravery'	=> $hasBravery,
			'maxBravery'	=> $maxBravery,
			'minBravery'	=> $minBravery,
			'rewardBravery'	=> $rewardBravery,
			'costBravery'	=> $costBravery,
			'responsible'	=> $responsible,
			'image'			=> $dungeonImageFileName,
		);
		
		$this->db->insert('temples', $data);
		$dungeonId = $this->db->insert_id();
		
		$data = array(
			'temple_id'		=> $dungeonId,
			'is_approved'	=> 0,
		);
		$this->db->insert('temple_approvals',$data);
		
		if($plugins){
			$data = array();
			foreach($plugins as $plugin){
				$data[] = array(
					'temple_id'	=> $dungeonId,
					'plugin_id'	=> $plugin['id']
				);
			}
			
			$this->db->insert_batch('temple_plugins',$data);
			
		}
		return true;
	}
	
	function updateDungeon($id, $name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins, 
						$finished, $visibility, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName){
		
		$data = array(
			'name'			=> $name,
			'entrancePosX'	=> $entrancePosX,
			'entrancePosY'	=> $entrancePosY,
			'entrancePosZ'	=> $entrancePosZ,
			'description'	=> $desc,
			'other'			=> $other,
			'is_finished'	=> $finished,
			'visibility'	=> $visibility,
			'hasBravery'	=> $hasBravery,
			'maxBravery'	=> $maxBravery,
			'minBravery'	=> $minBravery,
			'rewardBravery'	=> $rewardBravery,
			'costBravery'	=> $costBravery,
			'image'			=> $dungeonImageFileName,
		);
		
		$this->db->where('id',$id);
		$this->db->update('temples', $data);
		
		$this->db->where('temple_id', $id);
		$this->db->delete('temple_plugins'); 
		
		
		if($plugins){
			$data = array();
			foreach($plugins as $plugin){
				$data[] = array(
					'temple_id'	=> $id,
					'plugin_id'	=> $plugin['id']
				);
			}
			
			$this->db->insert_batch('temple_plugins',$data);
		}

		return true;
	}
	
	function getDungeon($id){
		
		$this->db->select('temples.name, temples.responsible, temples.entrancePosX, temples.entrancePosY, temples.entrancePosZ, temples.description,
						temples.other, temples.is_finished, temples.visibility, temples.hasBravery, temples.minBravery, temples.maxBravery, temples.rewardBravery,
						temples.costBravery,temples.visibility,temples.image,users.username,plugins.plugin_name');
		$this->db->from('temples');
		$this->db->where('temples.id',$id);
		$this->db->join('temple_plugins','temple_plugins.temple_id = temples.id','left');
		$this->db->join('plugins','plugins.id = temple_plugins.plugin_id','left');
		$this->db->join('users','users.id = temples.responsible','left');
		
		$query = $this->db->get();
		$res = array();
		
		foreach($query->result() as $row){
			$res['id'] = $id;
			$res['name'] = $row->name;
			$res['responsibleId'] = $row->responsible;
			$res['responsible'] = $row->username;
			$res['entrancePosX'] = $row->entrancePosX;
			$res['entrancePosY'] = $row->entrancePosY;
			$res['entrancePosZ'] = $row->entrancePosZ;
			$res['description'] = $row->description;
			$res['other'] = $row->other;
			$res['finished'] = $row->is_finished;
			$res['visibility'] = $row->visibility;
			$res['hasBravery'] = $row->hasBravery;
			$res['minBravery'] = $row->minBravery;
			$res['maxBravery'] = $row->maxBravery;
			$res['rewardBravery'] = $row->rewardBravery;
			$res['costBravery'] = $row->costBravery;
			$res['image'] = $row->image;
			$res['plugins'][] = $row->plugin_name;
			
		}
		
		return $res;
	}
	
	function removeDungeon($id){
		
		$this->db->select('image');
		$this->db->where('id',$id);
		$query = $this->db->get('temples');
		
		foreach($query->result() as $row){
			$oldImage = $row->image;
		}
	
		unlink("./uploads/$oldImage");
		unlink("./uploads/thumbs/$oldImage");
		
		$this->db->where('id',$id);
		$this->db->delete('temples');
	
		$this->db->where('temple_id',$id);
		$this->db->delete('temple_approvals');
	
		$this->db->where('temple_id',$id);
		$this->db->delete('temple_plugins');
		
		return true;
	}
	
	function getAllDungeons($showNotPublicDungeons, $showOnlyAdminDungeons, $approvedOrNot){
		$this->db->select('temples.id, temples.name,temples.description,temples.is_finished,temples.image,temples.hasBravery');
		
		if($approvedOrNot){
			$approvedOrNot = 1;
		}else{
			$approvedOrNot = 0;
		}
		
		$this->db->where('temple_approvals.is_approved',$approvedOrNot);
		
		if($showOnlyAdminDungeons){
			$this->db->where('temples.visibility <=',3);
		}elseif($showNotPublicDungeons){
			$this->db->where('temples.visibility <=', 2);
		}else{
			$this->db->where('temples.visibility',1);
		}
		$this->db->join('temple_approvals', 'temples.id = temple_approvals.temple_id','left');
		
		$query = $this->db->get('temples');
		$return = array();
		foreach ($query->result() as $row){
			$temp = array();
			$temp['id'] = $row->id;
			$temp['name'] = $row->name;
			$temp['desc'] = $row->description;
			$temp['finished'] = $row->is_finished;
			$temp['hasBravery'] = $row->hasBravery;
			$temp['image'] = $row->image;
			
			$return[] = $temp;
		}
		
		return $return;
	}
	
	function checkUnapprovedDungeons(){
		
		$this->db->select('temple_id');
		$this->db->where('is_approved',0);
		$query = $this->db->get('temple_approvals',1);
		
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function approveDungeon($id, $approver){
	
		$data = array(
			'is_approved'		=> 1,
			'approved_by'		=> $approver,
			'approved_date'		=> 'now()',
		);
		
		$this->db->where('temple_id',$id);
		$this->db->update('temple_approvals', $data);
		
	
		return true;
	}
}