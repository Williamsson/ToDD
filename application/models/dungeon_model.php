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
	
	function getAllDungeons(){
		
		$this->db->select('id,name,is_finished,description,hasBravery,minBravery,maxBravery');
		$this->db->where('public', 1);
		
		$query = $this->db->get('temples');
		
		$return = array();
		foreach ($query->result() as $row){
			$temp = array();
			$temp['id'] = $row->id;
			$temp['name'] = $row->name;
			$temp['finished'] = $row->is_finished;
			$temp['desc'] = $row->description;
			$temp['hasBravery'] = $row->hasBravery;
			$temp['minBravery'] = $row->minBravery;
			$temp['maxBravery'] = $row->maxBravery;
			$return[] = $temp;
		}
		
		return $return;
		
	}
	
}