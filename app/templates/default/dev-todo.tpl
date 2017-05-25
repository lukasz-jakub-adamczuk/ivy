		<article>
			<header class="inner">
				<h2>Aktualności</h2>
			</header>
			<section>
				news-info.tpl...{$base}/{$ctrl}/insert
				<!-- {$sForm} -->
				<form method="post" action="{$base}/{$ctrl}/insert" class="clearfix">
					<div class="main-form">
						<section>
						<!-- <fieldset> -->
							<legend>WAZNE</legend>
							<div class="row">
								<div class="label">
									<label for="news-title">Tytuł</label>
								</div>
								<div>
									<input id="news-title" name="dataset[title]" type="text" class="input" value="{$aFields.title}" placeholder="Wpisz tytuł aktualności" />
								</div>
							</div>
						</section>
					</div>
					<div class="buttons clear">
						<a href="{$sBaseUrl}/news" class="h-padding">Wstecz</a>
						<input type="submit" class="button" value="Zapisz" />
					</div>
				</form>
				...
				<h2>Todo</h2>
				<ul>
					<li>aaa</li>
				</ul>
				<h2>Done</h2>
				<ul>
					<li>aaa</li>
				</ul>
			</section>
		</article>