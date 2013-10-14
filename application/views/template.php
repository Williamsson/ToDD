<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title?></title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta name="description" content="<?php echo $description;?>"/>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<img src="<?php echo base_url();?>img/logo.png"/>
			<div id="nav">
				<ul>
					<li><a href="<?php echo base_url();?>">Home</a></li>
					<li><a href="<?php echo base_url();?>dungeons">List of all dungeons</a></li>
					
					<?php if($this->user_model->isAdmin()):?>
						<li><a href="<?php echo base_url();?>admin">Admin</a></li>
					<?php endif;?>
					
					<?php if($this->safety_model->isLoggedIn()):?>
						<li><a href="<?php echo base_url()?>user/logout">Logout</a>
					<?php endif;?>
				</ul>
			</div>
		</div>
		
		<div id="content">
			<?php $this->load->view($mainContent); ?>
			
			<div id="footer">
			
				<div class="col-3">
					<p>Hosted by: <a href="http://kbkompaniet.org" target="_blank">KBK</a></p>
					<p>Made by: <a href="http://wilsim.se" target="_blank">Williamsson</a></p>
				</div>
				
				<div class="col-3">
					<p>Play Minecraft on mc.kbkompaniet.org</p>
					<p>Visit our <a href="http://mc.kbkompaniet.org:8123" target="_blank">Dynmap</a></p>
				</div>
				
				<div class="col-3">
					<p>Visit <a href="http://minecraft.kbkompaniet.org" target="_blank">our website</a></p>
					<p>Lorem ipsum</p>
				</div>
			</div>
		</div>
		
		
	</div>
</body>
</html>