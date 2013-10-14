
<a href="<?php echo base_url();?>plugins/add">Add a plugin</a><br/><br/>
<table id="table-3">
	<tr>
		<th>Plugin name</th>
		<th>Plugin description:</th>
		<th>Currently active:</th>
		<th>Broken:</th>
		<th>Download link:</th>
		<th>Link to "wiki":</th>
		<th>Edit:</th>
		<th>REMOVE:</th>
	</tr>
<?php 
	$plugins = $this->general_model->getPluginList();
	
	foreach($plugins as $plugin){
		$id = $plugin['id'];
		$name = $plugin['name'];
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
				<a href="<?php echo base_url();?>plugins/edit/<?php echo $id;?>">Edit</a>
			</td>
			<td>
				<a href="<?php echo base_url();?>plugins/remove/<?php echo $id;?>">Remove</a>
			</td>
		</tr>

<?php 		
	}
	
?>
</table>