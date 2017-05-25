		<article>
			{include file='parts/index-header.tpl' header=$sHeader|default:$aSections.$ctrl.name}
			{include file='parts/sections.tpl'}
			<section class="container" style="margin-top: 3em;">
				<!-- <a href="{$base}/{$ctrl}/add">Nowy wpis</a> -->
				{*include file='parts/filters.tpl'*}
				
				{*include file='parts/paginator.tpl'*}
				<form method="post" action="{$base}/{$ctrl}">
					<div class="nav-bar border-top border-bottom bg-almost-white">
						{include file='parts/mass-actions.tpl'}
						{include file='parts/related-actions.tpl'}
						<span class="dev-button icon-checkmark" data-js="check-all"></span>
					</div>
					<input name="path" type="hidden" value="{$sPath}">

					<ul class="list-table">
						{foreach from=$aList item=item key=ik}
						<li{if isset($item.unread)} class="unverified"{/if}>
							<input id="item-{$ik}" name="ids[]" type="checkbox" value="{$item.hash|default:'null'}" class="list-checkbox mass-checkbox">
							<div>
								<div class="list-header">
									<time class="gray">{$item.date|default:'unknown'}</time> {if $item.lock eq false}<a href="{$base}/{$ctrl}/{$sPath}/lock/{$item.hash|default:'null'}" class="icon-lock gray" title="Zablokuj" data-js="lock"></a>{else}<a href="{$base}/{$ctrl}/{$sPath}/unlock/{$item.hash|default:'null'}" class="icon-lock black" title="Odblokuj" data-js="unlock"></a>{/if} <a href="{$item.link|default:'unknown'}" class="dark mobile-single-line">{$item.title|default:'unknown'}</a>
								</div>
								<label for="item-{$ik}" class="list-label">{$item.desc|default:'...'}
									<p class="relative">
										<a href="{$base}/{$ctrl}/{$sPath}/mark/{$item.hash|default:'null'}" data-js="mark">Oznacz jako przeczytany</a>
										<!-- <a href="{$base}/{$ctrl}/{$sPath}/write/{$item.hash|default:'null'}" data-js="mark-as-busy">Oznacz jako zajęty</a> -->
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
				{*include file='parts/paginator.tpl'*}
			</section>
		</article>