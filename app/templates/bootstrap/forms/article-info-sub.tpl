<section class="col sticky">
							{include file='controls/creation-date.tpl'}
							{include file='controls/modification-date.tpl'}
							{include file='controls/previewer.tpl'}
						</section>
						{include file='controls/section-buttons.tpl' publish=true}
						<section class="col">
							{include file='controls/authors.tpl'}
							{include file='controls/categories.tpl' cpk='id_article_category'}
							{include file='controls/templates.tpl' tpk='id_article_template'}
						</section>
						<section class="col">
							<div class="_row form-group">
								<div class="_label">
									<label>Opcje</label>
								</div>
								<div class="va-middle">
									{include file='controls/visible.tpl'}
									{include file='controls/verified.tpl'}
									{include file='controls/deleted.tpl'}
								</div>
							</div>
						</section>
						{include file='controls/option-buttons.tpl' promote=true}
						<section id="logo-image-fragment-div" class="col">
							{include file='controls/fragment-image.tpl' type='logo'}
						</section>
						<section id="cover-image-fragment-div" class="col">
							{include file='controls/fragment-image.tpl' type='cover'}
						</section>
						<section class="col">
							{include file='controls/changelogs.tpl' visible=false}
						</section>
						