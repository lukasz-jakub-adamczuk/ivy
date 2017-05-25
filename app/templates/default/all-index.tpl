		<article>
			{include file='parts/index-header.tpl' header=$sHeader|default:$aSections.$ctrl.name}
			{include file='parts/sections.tpl'}
			<section class="container">
				<!-- <a href="{$base}/{$ctrl}/add">Nowy wpis</a> -->
				{include file='parts/filters.tpl'}

				{*foreach from=$aNavigator item=nav key=nk}
				{$nk}: {$nav},
				{/foreach*}
				
				{include file='parts/paginator.tpl'}
				<form method="post" action="{$base}/{$ctrl}">
					<div class="nav-bar border-top bg-almost-white">
						{include file='parts/mass-actions.tpl'}
						{include file='parts/related-actions.tpl'}
					</div>

					{$sTable}
					
					<div class="nav-bar border-bottom bg-almost-white">
						{include file='parts/mass-actions.tpl'}
					</div>
				</form>
				{include file='parts/paginator.tpl'}
			</section>
		</article>