		<article class="container">
			{include file='parts/info-header.tpl' header=$sHeader}
			<section class="container_">
				<form method="post" action="{$base}/{$ctrl}/update-order">
					<input name="ctrl" type="hidden" value="{$sCtrl|default:$ctrl}">
					<ul id="sortable-categories" class="list-group sortable-list">
						{foreach from=$aElements item=elem key=k}
						<li class="list-group-item">
							<div class="item">
								<select id="item-{$k}" name="ids[{$k}]">
								{foreach from=$aOptions item=opt key=ok}
									<option value="{$opt}"{if $opt eq $elem.idx} selected="selected"{/if}>{$opt}</option>
								{/foreach}
								</select>
								{$elem.name}
							</div>
						</li>
						{/foreach}
					</ul>
					<div class="navbar">
						{include file='controls/buttons.tpl'}
					</div>
				</form>
			</section>
		</article>