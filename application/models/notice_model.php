<?php 
class Notice_model extends CI_Model{
	
	function getNoticeList($isBuilder, $isAdmin){
		
		if($isAdmin){
			$this->db->where('visibility <=',3);
		}elseif($isBuilder){
			$this->db->where('visibility <=', 2);
		}else{
			$this->db->where('visibility',1);
		}
		
		$this->db->select('news.id,news.title,news.author,news.posted,news.visibility,users.username');
		$this->db->join('users', 'news.author = users.id','left');
		$query = $this->db->get('news');
		
		$return = array();
		
		foreach ($query->result() as $row){
			
			$temp['id'] = $row->id;
			$temp['title'] = $row->title;
			$temp['posted'] = $row->posted;
			
			if(empty($row->username)){
				$temp['author'] = "User removed";
			}else{
				$temp['author'] = $row->username;
			}
			
			if($row->visibility == 1){
				$temp['visibility'] = "Public";
			}elseif($row->visibility == 2){
				$temp['visibility'] = "Builders";
			}elseif($row->visibility == 3){
				$temp['visibility'] = "Admins";
			}
			$return[] = $temp;
		}
		
		return $return;
		
	}
	
	function addNotice($id,$title,$posted,$visibility,$content){
		$data = array(
				'title'			=> $title,
				'content'		=> $content,
				'posted'		=> $posted,
				'author'		=> $id,
				'visibility'	=> $visibility,
		);
		
		$this->db->insert('news', $data);
		
		if($this->db->affected_rows() > 0){
			return true;
		}
		
		return false;
	}
	
	function getNotice($id){
		$this->db->select('news.title,news.content,news.posted,news.visibility,users.username');
		$this->db->where('news.id', $id);
		$this->db->join('users','users.id = news.author','left');
		$query = $this->db->get('news');
		$res = array();
		
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				
				$res['title'] = $row->title;
				$res['content'] = $row->content;
				$res['posted'] = $row->posted;
				$res['visibility'] = $row->visibility;
				
				if(empty($row->username)){
					$res['author'] = "User removed";
				}else{
					$res['author'] = $row->username;
				}
				
			}
			return $res;
		}else{
			return false;
		}
	}
	
	function updateNotice($id,$title,$posted,$visibility,$content){
		$data = array(
				'title'				=> $title,
				'posted'			=> $posted,
				'visibility'		=> $visibility,
				'content'			=> $content,
		);
		
		$this->db->where('id',$id);
		$query = $this->db->update('news', $data);
		
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	function deleteNotice($id){
		$this->db->where('id',$id);
		$this->db->delete('news');
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}