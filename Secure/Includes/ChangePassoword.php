<?php
require_once '../Core/Init.php';
$user=new User();
if(!$user->isLoggedIn()){
	Redirect::to(Index.php);
}

if(input::exists()){
	if(Token::check(input::get('token'))){
		$validate=new Validate();
		$validation=$validate->check($_POST, array(
			'password_current'=>array(
				'required'=>true,
				'min'=>6
			),
			'password_new'=>array(
				'required'=>true,
				'min'=>6
			),
			'password_new_again'=>array(
				'required'=>true,
				'min'=>6,
				'matches'=>'password_new'
			)

		));
		if($validation->passed())
		{
			if(Hash::make( Input::get('password_current'),$user->data()->salt) !==$user->data()->password)
			{
				echo 'Your current password is wrong';
			}
			else{

$salt=Hash::salt(32);
				$user->update(array(
					'password'=>Hash::make(Input::get('password_new'),$salt),
					'salt'=>$salt

				));
				Session::flash('home,your password has been changed');
				Redirect::to('Index.php');
			}
		}
		else{
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';

			}
		}
	}
}
?>

<form action="" method="Post">
<div class="field">
<label for="password_current">Password current</label>
<input type="password" name="password_current" id="password_current" value="" autocomplete="off">
</div>
<div class="field">
<label for="password_new">New password</label>
<input type="password" name="password_new" id="password_new" autocomplete="off">
</div>
<div class="field">
<label for="password_new_again">New password again</label>
<input type="password" name="password_new_again" id="password__new_again" autocomplete="off">
</div>

<input type="submit" value="Change">
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

</form>
	
