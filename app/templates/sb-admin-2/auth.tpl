<section class="col-fixed center">
	{include file='messages.tpl'}
	<form id="auth-form" method="post" action="{$base}/auth/login" class="margin light-theme border-radius">
		<div class="form-group">
			<label for="auth-user">Użytkownik</label>
			<input id="auth-user" name="auth[user]" type="text" class="form-control" placeholder="Nazwa użytkownika" />
		</div>
		<div class="form-group">
			<label for="auth-pass">Hasło</label>
			<input id="auth-pass" name="auth[pass]" type="password" class="form-control" placeholder="Hasło użytkonika" />
		</div>
		<div class="buttons">
			<input type="submit" class="button" value="Zaloguj" />
		</div>
	</form>
	<ul class="no-style">
		<li><a href="{$base}/auth/recover">Odzyskiwanie hasła</a></li>
		<li><a href="{$base}/home">Strona główna</a></li>
	</ul>
</section>