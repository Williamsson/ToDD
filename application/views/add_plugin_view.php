<h1>Add plugin</h1>
<div class="col-2">
	<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		echo validation_errors('<div class="error">','</div>');
		echo form_open('plugins/add');?>
		
		<label for="pluginName">Name of the plugin:*</label><br/>
			<input name="pluginName" type="text" value="<?php echo set_value('pluginName'); ?>" placeholder="Plugin name"/><br/>

		<label for="version">Version:</label><br/>
			<input name="version" type="text" value="<?php echo set_value('version'); ?>" placeholder="Version"/><br/>
		
		<label for="downloadLink">Link to the download:*</label><br/>
			<input name="downloadLink" type="text" value="<?php echo set_value('downloadLink'); ?>" placeholder="Download link"/><br/>
			
		<label for="wikiLink">Link to the wiki:</label><br/>
			<input name="wikiLink" type="text" value="<?php echo set_value('wikiLink'); ?>" placeholder="Link to the wiki"/><br/>
<?php 
			echo form_submit('submit','Add plugin');
			
			echo "<br/><br/><a href='" . base_url() . "plugins'>Back</a>";
?>
</div>
<div class="col-2">
	<label for="description">Last updated:</label><br/>
		(If you can't see a datepicker, use good browser<br/> or enter like YYYY-MM-DD)<br/>
		<input name="updated" type="date" value="<?php echo set_value('updated'); ?>"/><br/>
		
	<label for="description">Description:*</label><br/>
		<input name="description" type="text" value="<?php echo set_value('description'); ?>" placeholder="Description"/><br/>
	
	<label for="active">Is the plugin active:*</label><br/>
			<select name="active">
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select><br/>
	<label for="finished">Is the plugin broken:*</label><br/>
			<select name="broken">
				<option value="0">No</option>
				<option value="1">Yes</option>
			</select><br/>
			<?php 
				echo form_close();
			?>
</div>