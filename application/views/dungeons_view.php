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
		echo "<a href='" . base_url() . "dungeons/add'>Add a dungeon</a><br/><br/>"; 
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
	$dungeons = $this->dungeon_model->getAllDungeons();
	
	foreach($dungeons as $dungeon){?>
		<tr>
			<td><?php echo $dungeon['name']?></td>
			<td><?php echo $dungeon['desc']?></td>
			<td>
				<?php 
					if(!empty($dungeon['image'])){?>
						<a href="<?php echo base_url();?>uploads/<?php echo $dungeon['image'];?>"><img src="<?php echo base_url() . "uploads/thumbs/" . $dungeon['image'];?>"/></a>
<?php 					}else{
						echo "No image uploaded :(";
					}
				?>
			</td>
			<td><?php echo $dungeon['finished']?></td>
			<td><?php echo $dungeon['hasBravery']?></td>
		</tr>
		
<?php 		
	}
	
?>
</table>