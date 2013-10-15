<?php 
	if(!$this->uri->segment(3)){
		redirect('dungeons');
	}
?>
<script type="text/javascript" src="<?php echo base_url();?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<h1>Edit dungeon</h1>
<div class="col-2">
	<p>Here you may edit a dungeons.</p>
	
	<?php 
		$dungeonId = $this->uri->segment(3);
		$dungeon = $this->dungeon_model->getDungeon($dungeonId);
		
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		echo validation_errors('<div class="error">','</div>');
		echo form_open_multipart('dungeons/edit');
	?>
		<label for="dungeonName">Name of the dungeon:*</label><br/>
			<input type="text" name="dungeonName" value="<?php echo $dungeon['name']; ?>" placeholder="Dungeon name"/><br/>
			<input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>"/>
		<label>Change image</label><br/>
			<input type="file" title="dungeonImage" name="dungeonImage" size="20" /><br/>
			<input type="hidden" name="max_file_size" value="2048" /> 
		
		<label for="entrancePosX">Coordinates to dungeon entrance:*</label><br/>
			X:<input type="text" name="entrancePosX" placeholder="X" value="<?php echo $dungeon['entrancePosX']; ?>" size="2"/>
			Y<input type="text" name="entrancePosY" placeholder="Y" value="<?php echo $dungeon['entrancePosY']; ?>" size="2"/>
			Z:<input type="text" name="entrancePosZ" placeholder="Z" value="<?php echo $dungeon['entrancePosZ'];?>" size="2"/><br/>
			
		<label for="hasBravery">Is this dungeon using bravery:*</label><br/>
			<select name="hasBravery">
				<?php 
					if($dungeon['hasBravery'] == 0){?>
						<option selected value="0">No</option>
<?php 				}else{?>
						<option value="0">No</option>
<?php 				}
				?>
				<?php 
					if($dungeon['hasBravery'] == 1){?>
						<option selected value="1">Yes</option>
<?php 				}else{?>
						<option value="1">Yes</option>
<?php 				}
				?>
			</select><br/>
			<label for="minBravery">Minimum bravery:</label><br/>
				<input type="text" name="minBravery" placeholder="0" value="<?php echo $dungeon['minBravery']; ?>" size="2"/><br/>
			<label for="maxBravery">Maximum bravery:</label><br/>
				<input type="text" name="maxnBravery" placeholder="0" value="<?php echo $dungeon['maxBravery']; ?>" size="2"/><br/>
			<label for="costBravery">Cost bravery:</label><br/>
				<input type="text" name="costBravery" placeholder="0" value="<?php echo $dungeon['costBravery']; ?>" size="2"/><br/>
			<label for="rewardBravery">Reward bravery:<br/></label>
				<input type="text" name="rewardBravery" placeholder="0" value="<?php echo $dungeon['rewardBravery']; ?>" size="2"/><br/>
			
		<label for="finished">Is the temple finished?:*</label><br/>
			<select name="finished">
				<?php 
					if($dungeon['finished'] == 0){?>
						<option selected value="0">No</option>
<?php 				}else{?>
						<option value="0">No</option>
<?php 				}
				?>
				<?php 
					if($dungeon['finished'] == 1){?>
						<option selected value="1">Yes</option>
<?php 				}else{?>
						<option value="1">Yes</option>
<?php 				}
				?>
			</select><br/>
			
		<label for="public">Should this be viewable public?:*</label><br/>
			<select name="public">
				<?php 
					if($dungeon['public'] == 0){?>
						<option selected value="0">No</option>
<?php 				}else{?>
						<option value="0">No</option>
<?php 				}
				?>
				<?php 
					if($dungeon['public'] == 1){?>
						<option selected value="1">Yes</option>
<?php 				}else{?>
						<option value="1">Yes</option>
<?php 				}
				?>
			</select><br/>
			
		<label for="description">Give a description of the dungeon, it will be public:*</label><br/>
			<textarea name="description" placeholder="Description" style="width:100%"><?php echo $dungeon['description']; ?></textarea><br/>
			
		<label for="other">Other information, only admins see this:</label><br/>
			<textarea name="other" placeholder="Other"><?php echo $dungeon['other']; ?></textarea><br/>
	<?php 
		echo form_submit('submit', 'Update');
		echo "<br/><a href='" . base_url() . "dungeons/more/" . $this->uri->segment(3) . "'>Back</a>";
	?>
</div>
<div class="col-2">
	<p>Here you may select all the plugins that are used in this dungeon.</p>
	<?php 
		$plugins = $this->plugin_model->getPluginList($dungeon['plugins']);
		
		foreach($plugins as $plugin){
			if($plugin['checked']){ ?>
				<input type="checkbox" checked name="plugins[]" value="<?php echo $plugin['id'];?>"><?php echo $plugin['name']?><br/>
<?php 		}else{ ?>
				<input type="checkbox" name="plugins[]" value="<?php echo $plugin['id'];?>"><?php echo $plugin['name']?><br/>
<?php 		}
		} 
		echo form_close();
?>
</div>