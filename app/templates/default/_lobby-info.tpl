		<article>
			<header class="inner">
				<a href="{$base}/{$ctrl}" class="vam icon-arrow-left3"></a>
				<h2 class="vam">Lobby</h2>
			</header>
			<section>
				<form method="post" action="{$base}/{$ctrl}/{$sFormMode}" class="clearfix">
					<div class="main-form">
						<input name="object" type="hidden" value="{$aFields.object}" />
						{if isset($aFields.id_object)}
						<input name="id_object" type="hidden" value="{$aFields.id_object}" />
						{/if}
						<section>
							{include file='controls/title.tpl'}
							{include file='controls/editor.tpl'}
							{include file='controls/markup.tpl'}
							{include file='controls/markdown.tpl'}
						</section>
					</div>
					<div class="sub-form">
						<section class="col sticky">
							{include file='controls/creation-date.tpl'}
						</section>
						<section class="col bg-dark tar desktop-visible">
							<input type="button" class="button color" data-ajax="approve" value="Zaakceptuj" />
							<input type="submit" class="button" data-ajax="save" value="Zapisz" />
						</section>
						<section class="col">
							{include file='controls/authors.tpl'}
						</section>
						<section class="col">
							<div class="row">
								<div class="label">
									<label>Opcje</label>
								</div>
							</div>
						</section>
					</div>
					<div class="buttons clear">
						{include file='controls/buttons.tpl'}
					</div>
				</form>
			</section>
		</article>