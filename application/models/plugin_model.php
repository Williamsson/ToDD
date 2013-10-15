<?php 
class Plugin_model extends CI_Model{
	
	function getPluginList($checked = 0){
	
		$this->db->order_by('active','DESC');
		$this->db->order_by('name','ASC');
		$query = $this->db->get('plugins');
	
		$return = array();
	
		foreach ($query->result() as $row){
			$temp = array();
			$temp['id'] = $row->id;
			$temp['name'] = $row->name;
			$temp['version'] = $row->version;
			$temp['update'] = $row->last_update;
			$temp['active'] = $row->active;
			$temp['broken'] = $row->broken;
			$temp['desc'] = $row->description;
			$temp['link_download'] = $row->link_download;
			$temp['link_plugin'] = $row->link_plugin;
				
			if(is_array($checked) && in_array($row->id,$checked)){
				$temp['checked'] = true;
			}else{
				$temp['checked'] = false;
			}
			$return[] = $temp;
		}
		return $return;
	}
	
	function addPlugin($name, $version, $updated, $dlLink, $wikiLink, $desc, $active, $broken){
	
		$data = array(
				'name'			=> $name,
				'version'		=> $version,
				'last_update'	=> $updated,
				'link_download'	=> $dlLink,
				'link_plugin'	=> $wikiLink,
				'description'	=> $desc,
				'active'		=> $active,
				'broken'		=> $broken,
		);
	
		$this->db->insert('plugins', $data);
	
		if($this->db->affected_rows() > 0){
			return true;
		}
	
		return false;
	
	}
	
	function removePlugin($id){
		$this->db->where('id',$id);
		$this->db->delete('plugins');
		
		$this->db->where('plugin_id',$id);
		$this->db->delete('temple_plugins');
		
		return true;
	}
	
	function getPlugin($id){
		
		$query = $this->db->get_where('plugins', array('id'	=> $id));
		$result = array();

		foreach($query->result() as $row){
			
			$result['id'] = $row->id;
			$result['name'] = $row->name;
			$result['version'] = $row->version;
			$result['update'] = $row->last_update;
			$result['dl_link'] = $row->link_download;
			$result['link'] = $row->link_plugin;
			$result['desc'] = $row->description;
			$result['active'] = $row->active;
			$result['broken'] = $row->broken;
			
		}
		
		return $result;
		
	}
	
	function updatePlugin($id, $name, $version, $updated, $dlLink, $wikiLink, $desc, $active, $broken){
		
		$data = array(
				'name'			=> $name,
				'version'		=> $version,
				'last_update'	=> $updated,
				'link_download'	=> $dlLink,
				'link_plugin'	=> $wikiLink,
				'description'	=> $desc,
				'active'		=> $active,
				'broken'		=> $broken,
		);
		
		$this->db->where('id',$id);
		$this->db->update('plugins', $data);
		
		if($this->db->affected_rows() > 0){
			return true;
		}
		
		return false;
		
	}
	
	
	
}