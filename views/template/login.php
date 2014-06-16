<?php defined('GOLD') or exit('Access denied');?>

<div class="login">
<h2>Авторизация</h2>
	<p class="err">
	<?php if(isset($error)){
		echo $error;
	}?>
	</p>
	<form action='<?php echo SITE_URL;?>login' method='post'>
		<span>Логин:</span><br/>
		<input type='text' name = 'name' id="login" required="required" /><br/>
		<span>Пароль:</span><br/>
		<input type='password' name ='password' id="pass" required="required" /><br/>
		
		<input class="submit_login" type='submit' name='auth' id="auth" value ='Войти' /><br/>
	</form>
</div>