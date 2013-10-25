<?php 
class Page_model extends CI_Model{
	
	function getPages(){
		$this->db->select('id, title');
		$query = $this->db->get('pages');

		$return = array();
		foreach ($query->result() as $row){
			$temp['id'] = $row->id;
			$temp['title'] = $row->title;
			$return[] = $temp;
			
		}
		return $return;
	}
	
	
	
}