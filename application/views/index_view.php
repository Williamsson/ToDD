<h1>Greetings!</h1>

<p>This is the main hub for all the adventurers of Dertinia, where all the dungeons can be viewed - and some of them have their position marked.</p>
<p>The admins of the server can also see the plugins needed for all the dungeons, and other neat maintenance stuff</p>


<?php if(!$this->safety_model->isLoggedIn()){?>

<p>Login for admins:</p>
<?php 
	echo form_open('user/login');
?>
	<input type="text" name="username" placeholder="Username"/><br/>
	<input type="password" name="password" placeholder="Password"/><br/>
<?php 
	echo form_submit('login', 'Login');
	echo form_close();
}
?>