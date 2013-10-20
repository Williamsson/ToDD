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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
  $(function() {
    $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
  });
</script>
<h1>Create notice</h1>
<div class="col-2">
	<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		echo validation_errors('<div class="error">','</div>');
		echo form_open('notice/add');?>
		
		<label for="title">Title:*</label><br/>
			<input name="title" type="text" value="<?php echo set_value('title'); ?>" placeholder="Title"/><br/>
		
			<input type="hidden" name="author" value="<?php echo $this->session->userdata('userId');?>"/>
		
		<label for="posted">Posted*:</label><br/>
			<input id="datepicker" name="posted" type="text" value="<?php echo set_value('posted'); ?>"/><br/>
		
		<label for="visibility">Visibility:*</label><br/>
			<select name="visibility">
				<option value="1">Public</option>
				<option value="2">Builders</option>
				<option value="3">Admins</option>
			</select><br/>
			
		<label for="content">Content:*</label>
			<textarea name="content"><?php echo set_value('content'); ?></textarea>
<?php 
			echo form_submit('submit','Create notice');
			
			echo "<br/><br/><a href='" . base_url() . "admin'>Back</a>";
?>
</div>
<div class="col-2">
			<?php 
				echo form_close();
			?>
</div>