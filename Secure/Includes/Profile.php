 <?php
require_once '../Core/Init.php';
if(!$username=Input::get('user')){
	Redirect::to('Index.php');
}
else{
	$user=new User($username);
	if(!$user->exists()){
		Redirect::to(404);
	}
	else{
		$data=$user->data();
	}
	?>
	<h3><?php echo escape($data->username); ?></h3>
	<p>Full name: <?php echo escape($data->name); ?></p>
<?php
	}
