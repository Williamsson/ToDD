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
<?php if($this->user_model->isAdmin()){ echo "<a class='editImage' href='" . base_url() . "plugins/add'>Add a plugin</a><br/><br/>"; }?>
<?php 
	if($this->session->flashdata('message')){
		echo $this->session->flashdata('message');
	}
?>
<table id="table-3">
	<thead>
		<tr>
			<th>Plugin name</th>
			<th>Version</th>
			<th>Last updated</th>
			<th>Description:</th>
			<th>Currently active:</th>
			<th>Broken</th>
			<th>Download link</th>
			<th>Link to "wiki"</th>
			<th>Edit</th>
			<th>REMOVE</th>
		</tr>
	</thead>
<?php 
	$plugins = $this->plugin_model->getPluginList();
	
	foreach($plugins as $plugin){
		$id = $plugin['id'];
		$name = $plugin['name'];
		$version = $plugin['version'];
		$lastUpdate = $plugin['update'];
		$active = (int) $plugin['active'];
		
		if($active == 1){
			$active = "Yes";
		}else{
			$active = "No";
		}
		
		$broken = (int) $plugin['broken'];
		
		if($broken == 1){
			$broken = "Yes";
		}else{
			$broken = "No";
		}
		
		$desc = $plugin['desc'];
		$dlLink = $plugin['link_download'];
		$link = $plugin['link_plugin'];
?>
		<tr>
			<td>
				<?php echo $name;?>
			</td>
			<td>
				<?php echo $version;?>
			</td>
			<td>
				<?php echo $lastUpdate;?>
			</td>
			<td>
				<?php echo $desc;?>
			</td>
			<td>
				<?php echo $active;?>
			</td>
			<td>
				<?php echo $broken;?>
			</td>
			<td>
				<a href="<?php echo $dlLink;?>" target="_blank">Download link</a>
			</td>
			<td>
				<?php 
					if(!empty($link)){?>
						<a href="<?php echo $link;?>" target="_blank">Wiki link</a>
<?php 				}
				?>
			</td>
			<td>
				<?php if($this->user_model->isAdmin()){ echo "<a class='editImage' href='" . base_url() . "plugins/edit/$id'>Edit</a>"; }?>
			</td>
			<td>
				<?php if($this->user_model->isAdmin()){ echo "<a class='removeImage' href='" . base_url() . "plugins/delete/$id/$name'>Remove</a>"; }?>
			</td>
		</tr>

<?php 		
	}
	
?>
</table>