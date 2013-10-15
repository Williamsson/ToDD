<?php 
class User_model extends CI_Model{
	
	function login($username, $password){
	
		$this->db->select('username, password, id');
		$this->db->where('LOWER(username)', strtolower($username));
		$this->db->where('password', $password);
		
		$query = $this->db->get('users');
		
		if($query->num_rows > 0){
			$usernameDB = $query->row()->username;
			$passwordDB = $query->row()->password;
			$userId = $query->row()->id;
			
			if(strtolower($usernameDB) == strtolower($username) && $passwordDB = $password){
				$this->session->set_userdata('userId', $userId);
				echo $permId = $this->safety_model->getPermission($userId);
				$this->session->set_userdata('permission', $permId);
			}
		}else{
			$this->session->set_flashdata('message',"<div class='error'>Wrong username or password.</div>");
		}
		
	}
	
	function addUser($username, $password, $desc){
		$data = array(
				'username'		=> $username,
				'password'		=> $password,
				'description'	=> $desc,
		);
		
		$this->db->insert('users', $data);
		
		$id = $this->db->insert_id();
		
		$data = array(
				'user_id'		=> $id,
				'permission_id'	=> 1,
		);
		
		$this->db->insert('users_permissions', $data);
		
		if($this->db->affected_rows() > 0){
			return true;
		}
		
		return false;
	}
	
	function logout(){
		$this->session->sess_destroy();
	}
	
	function isAdmin(){
		if($this->session->userdata('permission') == 2){
			return true;
		}else{
			return false;
		}
	}
	
	function isBuilder(){
		if($this->session->userdata('permission') == 3){
			return true;
		}else{
			return false;
		}
	}
	
}