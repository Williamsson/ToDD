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
<h1>Manage users</h1>
<?php 
	$users = $this->user_model->getUserList();
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
<table id="table-3">
	<thead>
		<tr>
			<th>Username</th>
			<th>Description</th>
			<th>Set permission level</th>
			<th>Remove</th>
		</tr>
	</thead>
	<?php 
		foreach($users as $user){?>
			<tr>
				<td><?php echo $user['username'];?></td>
				<td><?php echo $user['desc'];?></td>
				<td>
					<?php 
						$permissionLevels = $this->safety_model->getAllPermissions();
						echo form_open('user/updatePermission');
						
						$options = array();
						foreach($permissionLevels as $perm){
							$options[$perm['id']] = $perm['name'];
						}
						echo form_dropdown('permission',$options,$user['permission']);
						echo form_hidden('id', $user['id']);
	 					echo form_submit('submit','OK');
						echo form_close();
					?>
				</td>
				<td>
					Placeholder
				</td>
			</tr>
<?php 	}
	?>		
</table>