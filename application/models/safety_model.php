<?php 
class Safety_model extends CI_Model{
	
	function isLoggedIn(){
		$userId = $this->session->userdata('userId');
		if($userId){
			return true;
		}else{
			return false;
		}
	}
	
	function getPermission($userId){
		$this->db->select('permission_id');
		$this->db->where('user_id', $userId);
		
		$query = $this->db->get('users_permissions');
		
		if($query->num_rows > 0){
			$permId = (int) $query->row()->permission_id;
			return $permId;
		}else{
			return false;
		}
	}
}