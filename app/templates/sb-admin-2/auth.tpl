		<section class="col-fixed center">
			{include file='messages.tpl'}
			<form id="auth-form" method="post" action="{$base}/auth/login" class="margin light-theme border-radius">
				<div class="row">
					<div class="label">
						<label for="auth-user">Użytkownik</label>
					</div>
					<div>
						<input id="auth-user" name="auth[user]" type="text" class="input" />
					</div>
				</div>
				<div class="row">
					<div class="label">
						<label for="auth-pass">Hasło</label>
					</div>
					<input id="auth-pass" name="auth[pass]" type="password" class="input" />
				</div>
				<div class="buttons">
					<input type="submit" class="button" value="Zaloguj" />
				</div>
			</form>
			{*<ul class="no-style">
				<li><a href="{$base}/auth/recover">Odzyskiwanie hasła</a></li>
				<li><a href="{$base}/home">Strona główna</a></li>
			</ul>*}
		</section>