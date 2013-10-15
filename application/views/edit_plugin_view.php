<h1>Edit plugin</h1>
<div class="col-2">
	<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		echo validation_errors('<div class="error">','</div>');
		
		$plugin = $this->plugin_model->getPlugin($this->uri->segment(3));
		
		echo form_open('plugins/edit');?>
		
		<label for="pluginName">Name of the plugin:*</label><br/>
			<input name="pluginName" type="text" value="<?php echo $plugin['name']; ?>" placeholder="Plugin name"/><br/>
			
			<input type="hidden" name="id" value="<?php echo $plugin['id'];?>"/>
			
		<label for="version">Version:</label><br/>
			<input name="version" type="text" value="<?php echo $plugin['version']; ?>" placeholder="Version"/><br/>
		
		<label for="downloadLink">Link to the download:*</label><br/>
			<input name="downloadLink" type="text" value="<?php echo $plugin['dl_link']; ?>" placeholder="Download link"/><br/>
			
		<label for="wikiLink">Link to the wiki:</label><br/>
			<input name="wikiLink" type="text" value="<?php echo $plugin['link']; ?>" placeholder="Link to the wiki"/><br/>
<?php 
			echo form_submit('submit','Update');
			
			echo "<br/><br/><a href='" . base_url() . "plugins'>Back</a>";
?>
</div>
<div class="col-2">
	<label for="description">Last updated:</label><br/>
		(If you can't see a datepicker, use good browser<br/> or enter like YYYY-MM-DD)<br/>
		<input name="updated" type="date" value="<?php echo $plugin['update']; ?>"/><br/>
		
	<label for="description">Description:*</label><br/>
		<input name="description" type="text" value="<?php echo $plugin['desc']; ?>" placeholder="Description"/><br/>
	
	<label for="active">Is the plugin active:*</label><br/>
			<select name="active">
				<?php 
					if($plugin['active'] == 0){?>
						<option selected value="0">No</option>
<?php 				}else{?>
						<option value="0">No</option>
<?php 				}
				?>
				<?php 
					if($plugin['active'] == 1){?>
						<option selected value="1">Yes</option>
<?php 				}else{?>
						<option value="1">Yes</option>
<?php 				}
				?>
			</select><br/>
	<label for="finished">Is the plugin broken:*</label><br/>
			<select name="broken">
				<?php 
					if($plugin['broken'] == 0){?>
						<option selected value="0">No</option>
<?php 				}else{?>
						<option value="0">No</option>
<?php 				}
				?>
				<?php 
					if($plugin['broken'] == 1){?>
						<option selected value="1">Yes</option>
<?php 				}else{?>
						<option value="1">Yes</option>
<?php 				}
				?>
			</select><br/>
			<?php 
				echo form_close();
			?>
</div>