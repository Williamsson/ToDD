<style type="text/css" title="currentStyle">
		@import "<?php echo base_url();?>js/datatables/media/css/demo_page.css";
		@import "<?php echo base_url();?>js/datatables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" src="<?php echo base_url();?>js/datatables/media/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/datatables/media/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#table-3').dataTable();
	} );
</script>
<?php 
	if($this->user_model->isAdmin()){ 
		echo "<a href='" . base_url() . "dungeons/add' class='editImage'>Add a dungeon</a><br/><br/>"; 
	}?>
	
	<table id="table-3">
		<thead>
			<tr>
				<th>Dungeon name</th>
				<th>Description</th>
				<th>Image</th>
				<th>Finished</th>
				<th>Using bravery</th>
			</tr>
		</thead>		
<?php 
	$showOnlyPublicDungeons = FALSE;
	if($this->safety_model->hasPermission(array('2','3'))){
		$showOnlyPublicDungeons = TRUE;
	}
	
	$showOnlyAdminDungeons = $this->user_model->isAdmin();
	
	$dungeons = $this->dungeon_model->getAllDungeons($showOnlyPublicDungeons, $showOnlyAdminDungeons);
	
	foreach($dungeons as $dungeon){
	?>
		<tr>
			<td>
				<?php 
					if($this->safety_model->hasPermission(array('2','3'))){
						echo "<a href='" . base_url() . "dungeons/more/" . $dungeon['id'] . "'> " . $dungeon['name'] . " </a>";
					}else{
						echo $dungeon['name'];
					}
				?>
			</td>
			<td><?php echo $dungeon['desc']?></td>
			<td>
				<?php 
					if(!empty($dungeon['image'])){?>
						<a href="<?php echo base_url();?>uploads/<?php echo $dungeon['image'];?>"><img src="<?php echo base_url() . "uploads/thumbs/" . $dungeon['image'];?>"/></a>
<?php 				}
				?>
			</td>
			<td>
			<?php
				if($dungeon['finished'] == 1){
					echo "Yes";
				} else{
					echo "No";
				}
			?>
			</td>
			<td>
				<?php
					if($dungeon['hasBravery'] == 1){
						echo "Yes";
					} else{
						echo "No";
					}
				?>
			</td>
		</tr>
		
<?php
	}
?>
</table>