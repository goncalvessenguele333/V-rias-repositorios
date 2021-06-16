 <?php
require_once '../Core/Init.php';


if(Session::exists('home')){
	echo '<p>'.Session::flash('home').'</p>';
}


$user=new User();
if($user->isLoggedIn()){
?>
 <a href="Profile.php?user=<?php echo escape($user->data()->username); ?>">User</a>
<ul>
	<li><a href="logout.php">Log out</a></li>
	<li><a href="Update.php">update</a></li>
	<li><a href="ChangePassoword.php">Change password</a></li>
</ul>
<?php 

  if($user->hasPermission('Admin')){
  	echo '<p> You are an administrator! </p>';
  }
}
else
{
	echo '<p>You nedd to <a href="Login.php">Log in</a> or <a                         href="Register.php">Register</a>';
}
