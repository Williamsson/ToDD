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
<h1>Edit notice</h1>
<div class="col-2">
	<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');
		}
		echo validation_errors('<div class="error">','</div>');
		echo form_open('notice/edit');
		$notice = $this->notice_model->getNotice($this->uri->segment(3));
		?>
		
		<label for="title">Title:*</label><br/>
			<input name="title" type="text" value="<?php echo $notice['title']; ?>" placeholder="Title"/><br/>
		
			<input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
		
		<label for="posted">Posted*:</label><br/>
			<input id="datepicker" name="posted" type="text" value="<?php echo $notice['posted']; ?>"/><br/>
		
		<label for="visibility">Visibility:*</label><br/>
			<select name="visibility">
				<option <?php if($notice['visibility'] == 1){echo "selected";}?> value="1">Public</option>
				<option <?php if($notice['visibility'] == 2){echo "selected";}?> value="2">Builders</option>
				<option <?php if($notice['visibility'] == 3){echo "selected";}?> value="3">Admins</option>
			</select><br/>
			
		<label for="content">Content:*</label>
			<textarea name="content"><?php echo $notice['content']; ?></textarea>
<?php 
			echo form_submit('submit','Update notice');
			
			echo "<br/><br/><a href='" . base_url() . "notice/more/" . $this->uri->segment(3) . "'>Back</a>";
?>
</div>
<div class="col-2">
			<?php 
				echo form_close();
			?>
</div>