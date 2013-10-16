<?php 
class Dungeon_model extends CI_Model{
	
	function addDungeon($name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins, 
						$finished, $public, $responsible, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName){
		$data = array(
			'name'			=> $name,
			'entrancePosX'	=> $entrancePosX,
			'entrancePosY'	=> $entrancePosY,
			'entrancePosZ'	=> $entrancePosZ,
			'description'	=> $desc,
			'other'			=> $other,
			'is_finished'	=> $finished,
			'public'		=> $public,
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
			$query = "INSERT INTO temple_plugins 
						(temple_id,plugin_id) 
						VALUES ";
			foreach($plugins as $plugin){
				$query .= "('$dungeonId','$plugin'),";
			}
			$query = substr_replace($query,"",-1);
			
			$this->db->query($query);
			
		}

		return true;
	}
	
	function updateDungeon($id, $name, $entrancePosX, $entrancePosY, $entrancePosZ, $desc, $other, $plugins, 
						$finished, $public, $hasBravery, $maxBravery, $minBravery, $rewardBravery, $costBravery, $dungeonImageFileName){
		
		$data = array(
			'name'			=> $name,
			'entrancePosX'	=> $entrancePosX,
			'entrancePosY'	=> $entrancePosY,
			'entrancePosZ'	=> $entrancePosZ,
			'description'	=> $desc,
			'other'			=> $other,
			'is_finished'	=> $finished,
			'public'		=> $public,
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
			$query = "INSERT INTO temple_plugins 
						(temple_id,plugin_id) 
						VALUES ";
			foreach($plugins as $plugin){
				$query .= "('$id','$plugin'),";
			}
			$query = substr_replace($query,"",-1);
			
			$this->db->query($query);
			
		}

		return true;
	}
	
	function getDungeon($id){
		
		$this->db->select('temples.name, temples.responsible, temples.entrancePosX, temples.entrancePosY, temples.entrancePosZ, temples.description,
						temples.other, temples.is_finished, temples.public, temples.hasBravery, temples.minBravery, temples.maxBravery, temples.rewardBravery,
						temples.costBravery,temples.image,users.username,plugins.plugin_name');
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
			$res['public'] = $row->public;
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
	
	function getAllDungeons($onlyPublic){
		$this->db->select('id, name,description,is_finished,image,hasBravery');
		
		if($onlyPublic){
			$this->db->where('public',1);
		}
		
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
	
}