<?php 
	$id = $this->uri->segment(3);
	$title = urldecode($this->uri->segment(4));
?>

<h1>Remove plugin: <?php echo $title;?></h1>
<p>Are you completely sure you want to remove this plugin from the system? Can't be undone.</p>

<?php 
	echo validation_errors('<div class="error">','</div>');
	echo form_open('notice/delete');?>
		<input name="id" type="hidden" value="<?php echo $id;?>"/>
<?php 
	echo form_submit('submit','Remove');
	echo form_close();
	
?>