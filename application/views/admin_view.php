<style type="text/css" title="currentStyle">
		@import "<?php echo base_url();?>js/datatables/media/css/demo_page.css";
		@import "<?php echo base_url();?>js/datatables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" src="<?php echo base_url();?>js/datatables/media/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/datatables/media/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready( function() {
	  $('#noticeBoard').dataTable( {
	    "aaSorting": [[2,'desc']]
	  } );
	} );
</script>
<?php 
	require_once("admin_left_menu.php");
?>

<div id="adminContent">
	<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
	?>
	
	<?php 
		if($this->dungeon_model->checkUnapprovedDungeons()){
			echo '<div class="noticeMessage"><a href="' . base_url() .'dungeons/approve">There are unapproved dungeons that await approval!</a></div>';
		}
	?>
	
	<h1>Noticeboard</h1>
	<a class='editImage' href="<?php echo base_url()?>notice/add">Create newspost</a>
	<table id="noticeBoard">
		<thead>
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Posted on the</th>
				<th>Visibility</th>
			</tr>
		</thead>
		
		<?php 
			$isAdmin = $this->user_model->isAdmin();
			$notices = $this->notice_model->getNoticeList(TRUE, $isAdmin);
			
			foreach($notices as $notice){?>
				<tr>
					<td><?php echo "<a href='" . base_url() . "notice/more/" . $notice['id'] . "'>" . $notice['title'] . "</a>";?></td>
					<td><?php echo $notice['author'];?></td>
					<td><?php echo $notice['posted'];?></td>
					<td><?php echo $notice['visibility'];?></td>
				</tr>
				
<?php 		}	?>
	</table>
</div>