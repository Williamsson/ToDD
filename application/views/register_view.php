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

<h1>Register a new user</h1>
<div class="col-2">
	<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		echo validation_errors('<div class="error">','</div>');
		echo form_open('user/register');?>
		
		<label for="username">Username:*</label><br/>
			<input type="text" value="<?php echo set_value('username');?>" name="username"/><br/>
			
		<label for="password">Password (minimum 6 chars):*</label><br/>
			<input type="password" name="password"/><br/>
			
		<label for="password">Repeat password:*</label><br/>
			<input type="password" value="" name="rpassword"/><br/>
	
		<label for="description">Profile:</label><br/>
			<textarea name="description"><?php echo set_value('description'); ?></textarea><br/>
	<?php 
		echo form_submit('submit','Register');
		echo form_close();	
	?>
</div>
<div class="col-2">
	<p>This is the cool, awesome, maintenance system for the Tales of Dertinia!</p>
</div>