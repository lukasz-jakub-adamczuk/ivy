<article>
	{include file='parts/index-header.tpl' header=$header|default:$sections.$ctrl.name}
	{include file='parts/sections.tpl'}
	<section class="container">
		<!-- <a href="{$base}/{$ctrl}/add">Nowy wpis</a> -->
		{include file='parts/filters.tpl'}
		
		{include file='parts/paginator.tpl'}
		<form method="post" action="{$base}/{$ctrl}">
			<div class="nav-bar border-top border-bottom bg-almost-white">
				{include file='parts/mass-actions.tpl'}
			&nbsp;&nbsp;&nbsp;
			<a href="{$base}/{$ctrl}" class="button icon-refresh"></a>
			<!-- <a href="{$base}/{$ctrl}/add" class="button icon-plus4"></a> -->

			</div>

			<ul class="list-table">
				{foreach from=$list item=item key=ik}
				<li>
					<input id="item-{$ik}" name="ids[]" type="checkbox" value="{$item.$sPrimaryKey}" class="list-checkbox mass-checkbox">
					<div>
						<div class="list-header">
							{*<span class="_vam">{$item.author|default:'Gość'}</span> <time class="gray">{$item.creation_date}</time>*} <a href="{$site}/{$ctrl|replace:'cleanup-':''}/{if isset($item.category_slug)}{$item.category_slug}/{/if}{$item.object_slug}" class="dark mobile-single-line">{if isset($item.category_name)}{$item.category_name} /{/if} {$item.object_name}</a>, <span class="gray">Ocena:</span> {$item.score|default:'brak'}, <span class="gray">Odsłony:</span> {$item.views}
						</div>
						<label for="item-{$item.$sPrimaryKey}" class="list-label">{$item.title|stripslashes|default:'...'}
						<p class="relative">
							<a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}" data-js="fast-edit">Edytuj</a> - <a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}/remove" data-js="remove"class="red">Usuń</a>
						</p>
						</label>
						
					</div>
				</li>
				{/foreach}
			</ul>
			
			<div class="nav-bar border-bottom bg-almost-white">
				{include file='parts/mass-actions.tpl'}
			</div>
		</form>
		{include file='parts/paginator.tpl'}
	</section>
</article>