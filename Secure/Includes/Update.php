<?php
require_once '../Core/Init.php';

 $user=new User();
 if(!$user->isLoggedIn()){
 	Redirect::to('Index.php');
 }


 if(Input::exists()){
 	if(Token::check(Input::get('token'))){
 		$validate=new Validate();
 		$validation=$validate->check($_POST, array(
 			'name'=>array(
 				'required'=>true,
 				'min'=>2,
 				'max'=>50
 			)
 		));
 		if($validation->passed()){
 			try{
 				$user->update(array(
 				'name'=>Input::get('name')
 			));
 				Session::flash('home, your datails have been updated.');
 				//Redirect::to('Index.php');
 				echo "Actualizado com sucesso!";

 			}catch(Exception $e){
 				die($e->getMessage());
 			}
 		}
 		else{
 			foreach ($validation->erros() as $error) {
 				echo $error, '<br>';
 			}
 		}
 	}
 }
?>

<form action="" method="Post">
	<div class="field">
		<label for="name">Name</label>
		<input type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
		<input type="submit" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	</div>
</form>
	