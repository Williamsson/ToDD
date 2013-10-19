<?php 
	$dungeonId = $this->uri->segment(3);
	
	$dungeon = $this->dungeon_model->getDungeon($dungeonId);
	
?>
<h1>More info</h1>
<div id="dungeonMore">

	<div class="col-3">
		<img src="<?php echo base_url() . "uploads/thumbs/" . $dungeon['image'];?>" />
		<h2><?php echo $dungeon['name']?></h2>
		<p>Location: <?php echo $dungeon['entrancePosX'] . " " . $dungeon['entrancePosY'] . " " . $dungeon['entrancePosZ'];?></p>
		<p>Finished: <?php if($dungeon['finished'] == 1){echo "Yes";}else{echo"No";};?></p>
		<p>Responsible: <?php echo "<a href='" . base_url() ."user/profile/" . $dungeon['responsibleId'] ."'>" . $dungeon['responsible'] . "</a>";?></p>
		<p>Visibility: 
					<?php 
						if($dungeon['visibility']==1){
							echo "Public";
						}elseif($dungeon['visibility']==2){
							echo "Builder";
						}elseif($dungeon['visibility']==3){
							echo "Admin";
						}
					?>
		</p>
		<p>Using bravery: <?php if($dungeon['hasBravery'] == 1){echo "Yes";}else{echo"No";};?></p>
		<p>Min bravery: <?php echo $dungeon['minBravery'];?></p>
		<p>Max bravery: <?php echo $dungeon['maxBravery'];?></p>
		<p>Cost bravery: <?php echo $dungeon['costBravery'];?></p>
		<p>Reward bravery: <?php echo $dungeon['rewardBravery'];?></p>
		<a class='editImage' href="<?php echo base_url() . "dungeons/edit/" . $this->uri->segment(3);?> ">Edit dungeon</a><br/><br/>
		<a class='removeImage' href="<?php echo base_url() . "dungeons/delete/" . $this->uri->segment(3) . "/" . $dungeon['name'];?>">Remove dungeon</a><br/><br/>
		<a href="<?php echo base_url();?>dungeons">Back</a>
	</div>
	
	<div class="col-3">
		<h3>Description:</h3>
		<p><?php echo $dungeon['description'];?>
		<h3>Other information:</h3>
		<p><?php echo $dungeon['other'];?>
	</div>
	
	<div class="col-3">
		<h3>Plugins used in this dungeon:</h3>
		<ul style="list-style-type:none;text-align:left;">
		<?php 
			foreach($dungeon['plugins'] as $plugin){
				echo "<li>$plugin</li>";
			}
		?>
		</ul>
	</div>
</div>