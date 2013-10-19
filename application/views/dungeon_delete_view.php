<?php 
	$id = $this->uri->segment(3);
	$name = urldecode($this->uri->segment(4));
?>

<h1>Remove dungeon: <?php echo $name;?></h1>
<p>Are you completely sure you want to remove this dungeon from the system? Can't be undone.</p>

<?php 
	echo validation_errors('<div class="error">','</div>');
	echo form_open('dungeons/delete');?>
		<input name="id" type="hidden" value="<?php echo $id;?>"/>
<?php 
	echo form_submit('submit','Remove');
	echo form_close();
	
?>