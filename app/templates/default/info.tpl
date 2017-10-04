		<article>
			<header class="inner">
				<h2>Info</h2>
			</header>
			<section>
				info.tpl
				<!-- {$sForm} -->
				<form method="post" action="" class="clearfix">
					<div class="main-form">
						<section>
						<!-- <fieldset> -->
							<legend>WAZNE</legend>
							<div class="row">
								<div class="label">
									<label for="title">Tytuł</label>
								</div>
								<div>
									<input id="title" name="title" type="text" class="input" placeholder="Wpisz tytuł artykułu" />
								</div>
							</div>
							<div class="row">
								<div class="label">
									<label for="markup">Treść</label>
								</div>
								<div>
									<textarea id="markup" name="markup" rows="10" cols="40" class="input" placeholder="Wpisz treść artykułu"></textarea>
								</div>
							</div>
						</section>
						<!-- </fieldset> -->
					</div>
					<div class="sub-form">
						<!-- <fieldset> -->
						<section class="col">
							<legend>Mniej wazne</legend>
							<div class="row">
								<div class="label">
									<label for="author">Autor</label>
								</div>
								<div>
									<input id="author" name="title" type="text" class="input" placeholder="Wpisz tytuł artykułu" />
								</div>
							</div>
							<div class="row">
								<div class="label">
									<label for="category">Kategoria</label>
								</div>
								<div>
									<select name="row">
									{foreach from=$categories item=c}
										<option value="{$c.name}">{$c.name}</option>
									{/foreach}
									</select>
								</div>
							</div>
							<div class="row">
								<div class="label">
									<label for="category">Kategoria</label>
								</div>
								<div>
									<select name="row" size="10">
									{foreach from=$categories item=c}
										<option value="{$c.name}">{$c.name}</option>
									{/foreach}
									</select>
								</div>
							</div>
						</section>
						<section class="col">
							<div class="row">
								<div class="label">
									<span>Widoczność</span>
								</div>
								<div>
									<input id="radio1" name="visible" type="radio" value="0" /><label for="radio1">Nie</label>
									<input id="radio2" name="visible" type="radio" value="1" /><label>Tak</label>
								</div>
							</div>
							<div class="row">
								<div class="label">
									<span>Widoczność inna</span>
								</div>
								<div class="va-middle">
									<div>
										<input id="radio11" name="visible" type="radio" value="0" /><label for="radio11">Nie</label>
									</div>
									<div>
										<input id="radio21" name="visible" type="radio" value="1" checked="checked" /><label for="radio21">Tak, a jak</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="label">
									<span>Poprawnocs</span>
								</div>
								<div class="">
									<div>
										<input id="check1" name="visible" type="checkbox" value="0" /><label for="check1">Nie</label>
									</div>
									<div>
										<input id="check2" name="visible" type="checkbox" value="1" checked /><label for="check2">Tak</label>
									</div>
									<div>
										<input id="check3" name="visible" type="checkbox" value="3" disabled /><label for="check3">Nie wiem</label>
									</div>
									<div>
										<input id="check4" name="visible" type="checkbox" value="4" /><label for="check4">Ale chce wiedziec</label>
									</div>
								</div>
							</div>
						</section>
						<!-- </fieldset> -->
						<!-- <fieldset> -->
						<!-- </fieldset> -->
					</div>
					<div class="buttons clear">
						<input type="submit" class="button" value="Wyślij" />
					</div>
				</form>
			</section>
		</article>