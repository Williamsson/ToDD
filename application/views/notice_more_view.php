<?php 
	$id = $this->uri->segment(3);
	$notice = $this->notice_model->getNotice($id);
	
	if(!$notice){
		redirect('admin');
	}
	if($notice['visibility'] > 1){
		if(!$this->user_model->isAdmin() && $notice['visibility'] > 2){
			redirect('admin');
		}
	}
?>
<h1><?php echo $notice['title']?></h1>
<p>This article was posted the <?php echo $notice['posted'];?> by: <?php echo $notice['author'];?></p>
<?php echo $notice['content'];?>

<?php 
	if($this->user_model->isAdmin()){
		echo "<a href='" . base_url() ."admin/'>Back</a><br/>";
		echo "<a class='editImage' href='" . base_url() ."notice/edit/" . $id ."/'>Edit</a><br/>";
		echo "<a class='removeImage' href='" . base_url() ."notice/delete/" . $id . "/" . $notice['title'] ."'>Remove</a>";
	}
?>